<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = "locations";
   protected $fillable=([
    "id",
    "location_code",
    "province",
    "district",
    "commune",
    "village",
    "desc",
   ]);
   public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function district()
    {
        return $this->belongsTo(districts::class, 'district_id');
    }

    public function jobLocations()
    {
        return $this->hasMany(JobLocation::class, 'location_code');
    }
}
