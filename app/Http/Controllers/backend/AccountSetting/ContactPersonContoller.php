<?php

namespace App\Http\Controllers\backend\AccountSetting;

use App\Http\Controllers\Controller;
use App\Models\company_profile;
use App\Models\employers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContactPersonContoller extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $companyProfileId = company_profile::where('user_id', $user->id)->value('id');
        $query = employers::query()->where('company_profile_id', $companyProfileId);
    
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }
    
        $contactPerson = $query->paginate(3); 
        return view("backend.Account_Setting.Contact_Person.index")->with('contactPerson', $contactPerson);
    }
    public function create(){
        return view("backend.Account_Setting.Contact_Person.create");
    }
    public function store(Request $request){
       $validadte= $request->validate([
           'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone' => 'required|string|max:11|min:8|regex:/^[0-9]+$/|unique:employers',
            'email' => 'required|email|max:255|unique:employers',
        ]);

        $user = Auth::user();
        $companyProfileId = company_profile::where('user_id', $user->id)->value('id');
      
        $contactPerson = new employers();
        $contactPerson->company_profile_id = $companyProfileId;
        $contactPerson->name = $request->name;
        $contactPerson->department = $request->department;
        $contactPerson->position = $request->position;
        $contactPerson->phone = $request->phone;
        $contactPerson->email = $request->email;
        $contactPerson->save();
        
       return redirect()->route('create_person')->with('success','Contact Person Added Successfully');

    }
  
    public function edit($id){
        $contactPerson = employers::findOrFail($id);
        employers::all()->where('id', $id)->first();
        return view("backend.Account_Setting.Contact_Person.edit")->with('contactPerson', $contactPerson);
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone' => 'required|string|max:9|min:9|regex:/^[0-9]+$/',
            'email' => 'required|email|max:255',
        ]);
    
        $contactPerson = employers::findOrFail($id);
        $contactPerson->name = $request->name;
        $contactPerson->department = $request->department;
        $contactPerson->position = $request->position;
        $contactPerson->phone = $request->phone;
        $contactPerson->email = $request->email;
        $contactPerson->save();
    
        return redirect()->route('contactPerson')->with('success', 'Contact person updated successfully.');
    }
    public function destroy($id){
        $contactPerson = employers::findOrFail($id);
        $contactPerson->delete();
    
        return redirect()->route('contactPerson')->with('success', 'Contact person deleted successfully.');
    }
}
