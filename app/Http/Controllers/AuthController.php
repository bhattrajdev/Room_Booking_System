<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSignupRequest;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    // for login
    public function login()
    {
        if (Auth::check()) {
            return redirect()->intended('/');
        }
        return view('pages.auth.login');
    }

    // public function postLogin(Request $request)
    // {

    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         dd(session()->get('url.intended'));

    //         // Redirect to the intended URL
    //         return redirect()->intended('/');
    //     }

    //     return redirect()->route('login')->with('error', 'Incorrect username or password');
    // }

    public function postLogin(Request $request)
    {
        // dd($request->all());
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $redirectTo = $request->redirectto;
            return redirect()->intended($redirectTo ? urldecode($redirectTo) : '/');
        }

        return redirect()->route('login')->with('error', 'Incorrect username or password')->withInput($request->except('password'));
    }




    // for signup method get
    function signup()
    {
        return view('pages.auth.signup');
    }


    // for signup method post
    function postSignup(StoreSignupRequest $request)
    {
        $validatedData =  $request->validated();
        $user = new User();
        $user->create($validatedData);
        return Redirect::route('login')->with('success', 'User Registered Successfully');
    }
    function getUsers()
    {
        $users = User::all();
        return view('pages.customer.viewcustomer')->with('users', $users);
    }


    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
