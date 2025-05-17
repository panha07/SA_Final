<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\company_profile;
use App\Models\employers;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function login()
    {
        return view("frontend.auth.login");
    }

    public function register()
    {
        return view("frontend.auth.register");
    }
    public function company_register()
    {
        return view("frontend.auth.company_register");
    }
    public function registration(Request $req)
    {
        $validateData = $req->validate([
            'first_name' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password',
            // 'terms' => 'accepted',
        ], [
            'first_name.required' => 'Please enter your first name.',
            'first_name.regex' => 'First name must only contain letters and spaces.',
            'last_name.required' => 'Please enter your last name.',
            'last_name.regex' => 'Last name must only contain letters and spaces.',
            'email.required' => 'Please provide an email address.',
            'email.email' => 'The email format is invalid.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Please enter a password.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'Password must be at least 1 character.',
            'confirm_password.required' => 'Please confirm your password.',
            'confirm_password.same' => 'Passwords do not match.',
            // 'terms.accepted' => 'You must accept the terms and conditions.',
        ]);
        $first_name = $validateData['first_name'];
        $last_name = $validateData['last_name'];
        $email = $validateData['email'];
        $password = $validateData['password'];
        user::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        return redirect()->route('frontend.login')->with('success', 'Registration successful!');
    }
    public function company_registration(Request $req)
{
    // Validation rules and messages
    $validatedData = $req->validate([
        'first_name' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
        'last_name' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:1',
        'confirm_password' => 'required|same:password',
        'company_name' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
        'industry' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
        'address' => 'required|min:2',
    ], [
        'first_name.required' => 'Please enter your first name.',
        'first_name.regex' => 'First name must only contain letters and spaces.',
        'last_name.required' => 'Please enter your last name.',
        'last_name.regex' => 'Last name must only contain letters and spaces.',
        'email.required' => 'Please provide an email address.',
        'email.email' => 'The email format is invalid.',
        'email.unique' => 'This email is already registered.',
        'password.required' => 'Please enter a password.',
        'password.min' => 'Password must be at least 1 character.',
        'confirm_password.required' => 'Please confirm your password.',
        'confirm_password.same' => 'Passwords do not match.',
        'company_name.required' => 'Company name is required.',
        'company_name.regex' => 'Company name can only contain letters and spaces.',
        'industry.required' => 'Industry is required.',
        'industry.regex' => 'Industry can only contain letters and spaces.',
        'address.required' => 'Address is required.',
        'address.min' => 'Address must be at least 2 characters.',
    ]);

    try {
        // Create user and assign admin role
        $user = user::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'admin', // Explicitly setting role as admin
        ]);

        // Create company profile linked to the user
        company_profile::create([
            'user_id' => $user->id,
            'name' => $validatedData['company_name'],
            'address' => $validatedData['address'],
            'industry' => $validatedData['industry'],
        ]) ->where("user_id",$user->id); 

        // Redirect to login with success message
        return redirect()->route('frontend.login')->with('success', 'Registration successful!');

    } catch (\Exception $e) {
        // Handle unexpected errors
        return redirect()->back()->withErrors(['error' => 'Registration failed. Please try again.']);
    }
}

    
    public function do_login(Request $req)
    {
        $validateData = $req->validate([
            'email' => "required|email",
            'password' => "required|min:1"
        ]);
        $email = $validateData['email'];
        $password = $validateData['password'];

        $credentials = $req->only('email', 'password');
        $remember = $req->has('rememberMe');
        $user = user::where('email', $req->email)->first();

        if ($user) {
            if ($user->status == 1) {
                if (Auth::attempt($credentials, $remember)) {
                    return redirect()->route('job');
                } else {
                    Session::flash('error', 'Incorrect Email or Password!');
                    return redirect()->route('frontend.login');
                }
            } elseif ($user->status == 0) {
                Session::flash('error', 'Your account is locked. Please contact support.');
                return redirect()->route('frontend.login');
            } else
                Session::flash('error', 'This email is not registered!');
            return redirect()->route('frontend.login');
        } else {

            Session::flash('error', 'This email is not registered!');
            return redirect()->route('frontend.login');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('frontend.login')->with("seccess", "Logout Successful!");
    }
}
