<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\CompanyDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileSettingController extends Controller
{
    public function getProfileDetails()
    {
        $max_upload = (int)(ini_get('upload_max_filesize'));
        $max_post = (int)(ini_get('post_max_size'));
        $memory_limit = (int)(ini_get('memory_limit'));
        $upload_mb = min($max_upload, $max_post, $memory_limit);

        $user = User::whereId(auth()->user()->id)->first();

        return response()->json([
            'response_code' => 200,
            'data' => [
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile_image_url' => $user->profile_image_url
                ],
                'upload_limit_mbs' => $upload_mb
            ]
        ]);
    }

    public function updateProfileDetails(Request $request)
    {
        
     
        
        $validator = Validator::make($request->all(), ['name' => 'required',
        'email' => 'required|email|unique:users,email,'.auth()->user()->id]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }


        $user = auth()->user();

        if ($request->has('img')) {
            // store image
            // $path = 'public/user-uploads/profile-images/'.$user->id;
            $path = 'user-uploads/profile-images/'.$user->id;

            if (!is_null($user->profile_image)) {
                Storage::delete($path.'/'.$user->profile_image);
            }

            $request->img->store($path);

            $user->profile_image = $request->img->hashName();
            //   $user->profile_image = $request->img->hashName();
            request()->img->move($path, $user->profile_image);
        }

        $user->name = $request->name;
        $user->save();

        return response()->json([
            'response_code' => 200,
            'message' => 'Profile Detail updated successfully.',
            'data' => [
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    // 'profile_image_url' => $user->profile_image_url
                    'profile_image_url' => public_path('user-uploads/profile-images/'.$user->id.'/'.$user->profile_image)
                ]
            ]
        ]);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/|min:8|max:12',
            'password_confirmation' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/|min:8|max:12'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response_code' => 422,
                'message' => 'Enter valid Credentials.',
                'errors' => $validator->errors()
            ], 422);
        }


        $user = auth()->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'response_code' => 422,
                'message' => 'Current Password did not match.',
                'errors' => [
                    'old_password' => [
                        'Incorrect Old Password. Try Again...'
                    ]
                ],
            ], 422);
        }
        $user->password = bcrypt($request->password);

        $user->save();

        return response()->json([
            'response_code' => 200,
            'message' => 'Password changed successfully.',
            'data' => []
        ]);
    }

    public function getCompanyDetails()
    {
        $companyDetail = CompanyDetail::whereUserId(auth()->user()->id)->first();

        return response()->json([
            'response_code' => 200,
            'data' => [
                'company_details' => [
                    'company_name' => $companyDetail->company_name,
                    'abn' => $companyDetail->abn,
                    'mobile_number' => $companyDetail->mobile_number,
                    'email' => $companyDetail->email,
                    'po_box' => $companyDetail->po_box,
                    'gst' => $companyDetail->gst,
                    'check_gst' => $companyDetail->check_gst,
                    'timezone' => $companyDetail->timezone,
                    'company_image_url' => $companyDetail->company_image_url
                    
                ]
            ]
        ]);
    }

    public function getTimezoneList()
    {
        return response()->json([
            'response_code' => 200,
            'data' => [
                'timezones' => config('timezones')
            ]
        ]);
    }

    public function updateCompanyDetails(UpdateCompanyRequest $request)
    {
        $companyDetail = auth()->user()->company_detail;

        if ($request->has('img2')) {
            // store image
            // $path = 'public/user-uploads/company-images/'.$companyDetail->id;
                $path = 'user-uploads/company-images/'.$companyDetail->id;
            

            if (!is_null($companyDetail->company_image)) {
                Storage::delete($path.'/'.$companyDetail->company_image);
            }

            // $request->img2->store($path);
            
            $companyDetail->company_image = $request->img2->hashName();
            request()->img2->move($path, $companyDetail->company_image);

            // $companyDetail->company_image = $request->img2->hashName();
        }

        $companyDetail->user_id = auth()->user()->id;
        $companyDetail->company_name = $request->cname;
        $companyDetail->abn = $request->abn;
        $companyDetail->mobile_number = $request->phone;
        $companyDetail->email = $request->email;
        $companyDetail->po_box = $request->pobox;
        $companyDetail->gst = $request->gst;
        $companyDetail->check_gst = $request->check_gst;
        $companyDetail->timezone = $request->timezone;
        $companyDetail->save();

        return response()->json([
            'response_code' => 200,
            'message' => 'Company Detail updated successfully.',
            'data' => [
                'company_details' => [
                    'company_name' => $companyDetail->company_name,
                    'abn' => $companyDetail->abn,
                    'mobile_number' => $companyDetail->mobile_number,
                    'email' => $companyDetail->email,
                    'po_box' => $companyDetail->po_box,
                    'gst' => $companyDetail->gst,
                    'check_gst' => $companyDetail->check_gst,
                    'timezone' => $companyDetail->timezone,
                    // 'company_image_url' => $companyDetail->company_image_url
                    'company_image_url' => public_path('user-uploads/company-images/'.$companyDetail->id.'/'.$companyDetail->company_image_url)

                    // 'company_image_url' => $companyDetail->company_image_url
                ]
            ]
        ]);
    }

    public function getEmailTemplate()
    {
        $companyDetail = auth()->user()->company_detail;

        return response()->json([
            'response_code' => 200,
            'data' => [
                'email_template' => $companyDetail->email_template,
                'email_subject' => $companyDetail->email_subject
            ]
        ]);
    }

    public function updateEmailTemplate(Request $request)
    {
        $companyDetail = auth()->user()->company_detail;

        $companyDetail->user_id = auth()->user()->id;
        $companyDetail->email_template = $request->editor;
        $companyDetail->email_subject = $request->email_subject;

        $companyDetail->save();

        return response()->json([
            'response_code' => 200,
            'message' => 'Email Template updated successfully.',
            'data' => [
                'email_template' => $companyDetail->email_template,
                'email_subject' => $companyDetail->email_subject
            ]
        ]);
    }

    public function changeTheme(Request $request)
    {
        $user = auth()->user();

        $user->theme = $request->is_theme_dark ? 'dark' : 'light';

        $user->save();

        return response()->json([
            'response_code' => 200,
            'message' => 'Theme changed successfully.',
            'data' => [
                'is_theme_dark' => auth()->user()->theme == 'dark' ? true : false
            ]
        ]);
    }
}
