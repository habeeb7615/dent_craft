<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        $timezone = CompanyDetail::select('id', 'timezone')->first()->timezone;
        if (auth()->user()) {
            $timezone = auth()->user()->company_detail->timezone;
        }
        return Carbon::parse($value)->timezone($timezone)->format('jS F Y \a\t H:i A');
    }
}
