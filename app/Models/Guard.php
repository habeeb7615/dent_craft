<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guard extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function damaged_areas()
    {
        return $this->belongsToMany(DamagedArea::class);
    }
}
