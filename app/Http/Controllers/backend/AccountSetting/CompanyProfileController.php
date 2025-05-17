<?php

namespace App\Http\Controllers\backend\AccountSetting;

use App\Http\Controllers\Controller;
use App\Models\company_profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        $companyProfile = company_profile::where('user_id', $user->id)->first();
        return view('backend.Account_Setting.Company_Profile.index', compact('companyProfile'));
    }
    public function update(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'website' => 'required|url|max:255',
            'description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $companyProfile = company_profile::where('user_id', $user->id)->first();

        $companyProfile->name = $request->name;
        $companyProfile->address = $request->address;
        $companyProfile->industry = $request->industry;
        $companyProfile->website = $request->website;
        $companyProfile->description = $request->description;

        if ($request->hasFile('logo')) {
          
            if ($companyProfile->logo) {
                Storage::delete('public/' . $companyProfile->logo);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
            $companyProfile->logo = $logoPath;
        }
        $companyProfile->save();

        return redirect()->route('company_profile')->with('success', 'Company profile updated successfully.');
    }
}
