<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\CannedComment;
use App\Models\CompanyDetail;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileSettingController extends Controller
{
    public function profileSettings()
    {
        $max_upload = (int)(ini_get('upload_max_filesize'));
        $max_post = (int)(ini_get('post_max_size'));
        $memory_limit = (int)(ini_get('memory_limit'));
        $upload_mb = min($max_upload, $max_post, $memory_limit);

        $user = User::whereId(auth()->user()->id)->with('company_detail')->first();

        return view('pages.profile_settings', compact('user', 'upload_mb'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        if ($request->has('img')) {
            // store image
            $path = 'user-uploads/profile-images/'.$user->id;

            if (!is_null($user->profile_image)) {
                Storage::delete($path.'/'.$user->profile_image);
            }

            $request->img->store($path);


            $user->profile_image = $request->img->hashName();
            request()->img->move($path, $user->profile_image);
        }

        $user->name = $request->name;
        $user->save();

        return response([
            'profile_image_url' => public_path('user-uploads/profile-images/'.$user->id.'/'.$user->profile_image),
            'user_name' => $user->name
        ]);
    }

    public function getChangePassword()
    {
        return view('pages.change_password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'status' => 422,
                'errors' => [
                    'old_password' => [
                        'Incorrect Old Password. Try Again...'
                    ]
                ],
            ], 422);
        }
        $user->password = bcrypt($request->password);

        $user->save();

        Auth::logout();

        return redirect(route('login'));
    }

    public function updateCompany(UpdateCompanyRequest $request)
    {
        $companyDetail = auth()->user()->company_detail;

        if ($request->has('img2')) {
            // store image
            $path = 'user-uploads/company-images/'.$companyDetail->id;

            if (!is_null($companyDetail->company_image)) {
                Storage::delete($path.'/'.$companyDetail->company_image);
            }

            // $request->img2->store($path);

            $companyDetail->company_image = $request->img2->hashName();
            request()->img2->move($path, $companyDetail->company_image);
        }

        $companyDetail->user_id = auth()->user()->id;
        $companyDetail->company_name = $request->cname;
        $companyDetail->abn = $request->abn;
        $companyDetail->mobile_number = $request->phone;
        $companyDetail->email = $request->email;
        $companyDetail->po_box = $request->pobox;
        $companyDetail->gst = $request->gst;
        $companyDetail->check_gst = $request->has('check_gst') ? 1 : 0;
        $companyDetail->timezone = $request->timezone;
        $companyDetail->save();

        return redirect()->back();
    }

    public function getEmailAndComments()
    {
        $emailTemplate = auth()->user()->company_detail->email_template;
                $email_subject =auth()->user()->company_detail->email_subject;

        $cannedComments = CannedComment::orderBy('created_at', 'desc')->get();

        return view('pages.email_and_comments', compact('emailTemplate', 'cannedComments','email_subject'));
    }

    public function updateEmailTemplate(Request $request)
    {
        
        $companyDetail = auth()->user()->company_detail;
         
        $companyDetail->user_id = auth()->user()->id;
        $companyDetail->email_template = $request->editor;
        $companyDetail->email_subject = $request->subject;

        $companyDetail->save();

        return redirect()->back();
    }

    public function checkVehicleRegistration()
    {
        $states = State::all();

        return view('pages.check_vehicle_registration', compact('states'));
    }

    public function changeTheme(Request $request)
    {
        $user = auth()->user();

        $user->theme = $request->theme;

        $user->save();

        return response()->json([
            'user' => $user
        ]);
    }
}
