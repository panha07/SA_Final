<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobLocation extends Model
{
    protected $table = 'job_location';

    protected $fillable = [
        'id',
        'location_id',
        'job_id',

    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function workingLocation()
{
    return $this->belongsTo(LocationWorking::class, 'location_id', 'location_code');
}
    
    public function job()
    {
        return $this->belongsTo(Job::class, 'id', "id");
    }
}
