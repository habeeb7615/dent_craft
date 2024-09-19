<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamagedArea extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function quotes()
    {
        return $this->belongsToMany(Quote::class);
    }

    public function guards()
    {
        return $this->belongsToMany(Guard::class)->orderBy('id', 'DESC')->withPivot('panel_cost');
    }
}
