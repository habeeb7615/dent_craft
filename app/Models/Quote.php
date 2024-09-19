<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function customer_detail()
    {
        return $this->hasOne(CustomerDetail::class);
    }

    public function vehicle_detail()
    {
        return $this->hasOne(VehicleDetail::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function assessed_images()
    {
        return $this->hasMany(Image::class)->whereImageType('assessed_damage');
    }

    public function pec_images()
    {
        return $this->hasMany(Image::class)->whereImageType('pre_existing_condition');
    }

    public function custom_damaged_areas()
    {
        return $this->hasMany(DamagedArea::class);
    }

    public function damaged_areas()
    {
        return $this->belongsToMany(DamagedArea::class);
    }

    public function custom_parts()
    {
        return $this->hasMany(Part::class);
    }

    public function parts()
    {
        return $this->belongsToMany(Part::class)->withPivot(['part_quantity', 'part_total']);
    }

    public function additional_value()
    {
        return $this->hasOne(AdditionalValue::class);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function pre_existing_conditions()
    {
        return $this->belongsToMany(PreExistingCondition::class);
    }

    public function getCreatedAtAttribute($value)
    {
        $timezone = CompanyDetail::select('id', 'timezone')->first()->timezone;
        if (auth()->user()) {
            $timezone = auth()->user()->company_detail->timezone;
        }
        return Carbon::parse($value)->timezone($timezone)->format('jS F Y');
    }
}
