<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function canned_comments()
    {
        return $this->hasMany(CannedComment::class);
    }

    public function company_detail()
    {
        return $this->hasOne(CompanyDetail::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function getProfileImageUrlAttribute()
    {
        return is_null($this->profile_image) ? asset('assets/images/Screenshot_20180719-223751_Google_1614630209.jpg') : asset('user-uploads/profile-images/'.$this->id.'/'.$this->profile_image);
    }
}
