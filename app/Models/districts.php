<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class districts extends Model
{
    protected $table = 'district';
    protected $fillable = [
        "id",
        "district",
        "province_id",
    ];
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

}
