<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function getImageUrlAttribute($value)
    {
        return asset('user-uploads/quotation-images/'.$this->quote_id.'/'.$value);
    }
}
