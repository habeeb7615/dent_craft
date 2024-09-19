<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreExistingCondition extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function quotes()
    {
        return $this->belongsToMany(Quote::class);
    }
}
