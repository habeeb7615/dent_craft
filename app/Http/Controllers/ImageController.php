<?php

namespace App\Http\Controllers;

use App\Http\Requests\Images\StoreRequest;
use App\Models\Image;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function uploadPreImages(StoreRequest $request)
    {
        $quote = Quote::select('id')->with('images')->whereId($request->main_id)->first();
        if ($request->has('page_three_image')) {
            $path = $request->file('page_three_image')->store('public/user-uploads/photos/'.$quote->id);
            $size = Storage::size($path);

            $image = $quote->images()->create([
                'image_url' => str_replace('public/', '', $path),
                'image_type' => $request->access_type == 1 ? 'assessed_damage' : 'pre_existing_condition',
                'image_size' => $size
            ]);

            $img ='<div class="col-lg-3 col-md-4 col-sm-6" id="img_ac_'.$image->id.'">
                        <div class="col-sm-12 col-md-12 imgUp">
                            <button onclick="delete_img('.$image->id.')" type="button" class="close" data-dismiss="modal"><i class="la la-trash"></i></button>
                            <img src="'.asset($image->image_url).'" class="pe-img" id="access_1">
                        </div>
                    </div>';

            return response([
                'image' => $img,
                'typeacc' => $image->image_type
            ], 200);
        }

        return response([]);

    }

    public function deleteQuoteImage(Request $request, $id)
    {
        $image = Image::whereId($id)->first();

        Storage::delete('public/'.$image->image_url);

        $image->delete();

        return response([]);
    }

    public function checkImageAttached(Request $request)
    {
        $quote = Quote::select('id', 'attach_images_in_email')->whereId($request->main_id)->first();

        $quote->attach_images_in_email = $request->id;

        $quote->save();

        return response(['quote' => $quote]);
    }

    public function checkEmailAttachment(Request $request, Quote $quote)
    {
        $sum = $quote->images()->sum('image_size');

        $mbs = number_format($sum/1000000, 2, '.', ',');

        return response([
            'size' => $mbs
        ]);
    }
}
