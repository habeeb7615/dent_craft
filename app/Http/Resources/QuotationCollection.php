<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuotationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'response_code' => 200,
            'data' => [
                'collection' => $this->collection,
                'image_url' => $this->assessed_images->first()->image_url
            ],
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
