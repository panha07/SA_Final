<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class province extends Model
{
    protected $table = 'province';
    protected $fillable = [
        "id",
        'province',
    ];
    public function districts()
    {
        return $this->hasMany(districts::class);
    }
    public function locations()
    {
        return $this->hasMany(Location::class, 'province_id');
    }
}
