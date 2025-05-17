<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class company_profile extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'address',
        'email',
        'phone',
        'description',
        'logo',
        'website',
        'industry',
    ];
    public function employers()
{
    return $this->hasMany(employers::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}
}
