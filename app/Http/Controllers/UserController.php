<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Returns view to register page
    public function getRegister()
    {
        return view('user.register');
    }

    // Handles the registration to the database
    // Then it will return you to the homepage
    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4'
        ]);

        $user = new User([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->save();

        return redirect()->route('/');
    }

    // Returns view to login page
    public function getLogin()
    {
        return view('user.login');
    }

    // Handles the registration to the database
    // Then it will return you to the homepage
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:4'
        ]);

        $user = new User([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('user.profile');
        }
        return redirect()->back();
    }

    // Returns view to profile page
    public function getProfile()
    {
        return view('user.profile');
    }
}
