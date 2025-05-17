<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationWorking extends Model
{
    protected $table = 'locations';

    protected $fillable = [
        'province_id',
        'id',
        'district_id',
        'desc',
        'location_code',
        
    ];
    // Relationships
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
        return $this->hasMany(JobLocation::class, 'location_id'); 
    }
    
}
