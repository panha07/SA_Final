<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\districts;
use Illuminate\Http\Request;

class LocationContorller extends Controller
{
    public function getDistricts($provinceId)
    {
        
        $districts = districts::where('province_id', $provinceId)
        ->orderBy('district', 'asc')
        ->get();
        return response()->json($districts);
    }
}
