<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalValue extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}
