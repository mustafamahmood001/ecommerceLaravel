<?php

namespace App\Http\Controllers;

use App\Events\WelcomeEvent;
use App\Mail\WelcomeMail;
use App\Models\Country;
use App\Models\ecommerce;
use Illuminate\Http\Request;
use App\Http\Requests\SignUpFormRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{

    // Registration view and submit function
    public function Registrationform(Request $request)
    {


        return view('signup.signUpForm');
    }
    public function userstore(SignUpFormRequest $SignUpFormRequest)
    {
        $photoPath = $SignUpFormRequest->file('photo')->store('userphoto', 'public');
        
        $ecommerce = new ecommerce([
            'fname' => $SignUpFormRequest->input('fname'),
            'lname' => $SignUpFormRequest->input('lname'),
            'email' => $SignUpFormRequest->input('email'),
            'password' => bcrypt($SignUpFormRequest->input('password')),
            'country' => $SignUpFormRequest->input('country'),
            'city' => $SignUpFormRequest->input('city'),
            'gender' => $SignUpFormRequest->input('gender'),
            'photo' => $photoPath, 
        ]);
        
        $ecommerce->save();
        // event(new WelcomeEvent($ecommerce));
 
        return redirect()->route('logform')->with('message', 'Registered Successfully');
    }
    // Login Form view and loginAuthenticate function
    public function loginform(Request $request)
    {

        return view('loginForm.loginForm');
    }
    public function loginAuthenticate(Request $request)
{
    $this->validate($request, 
    [
        'email' => 'required|exists:App\Models\Ecommerce,email',
        'password' => 'required',
], [
    'email.required' => 'Email is required',
    'email.exists' => 'Incorrect email',
    'password.required' => 'Password is required',
]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Authentication successful
    
        if (auth()->user()->role == 'admin') {
            // Redirect to the admin home page if the user is an admin
            return redirect()->route('adminhome')->with('message', 'Login Successfully')->setStatusCode(301);
        } else {
            // Redirect to the default home page for non-admin users
            return redirect()->route('homes')->with('message', 'Login Successfully')->setStatusCode(301);
        }
    } else {
        // Authentication failed
    
        // Redirect back to the login form with an error message
        return redirect()->route('logform')->with('error', 'Incorrect Email or Password')->setStatusCode(301);
    }
}
        

   
    public function logoutAction(Request $request)
{
    Auth::logout();

    Session::flush();

      return redirect('/');

    }
    

    
}
