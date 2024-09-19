<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCompanyImageUrlAttribute()
    {
        return is_null($this->company_image) ? asset('assets/images/DENTCRAFT Logo-2_1614600128.png') : asset('user-uploads/company-images/'.$this->id.'/'.$this->company_image);
    }
}
