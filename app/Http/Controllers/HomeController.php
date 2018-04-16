<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function showChangePasswordForm(){
        return view('auth.changepassword');
    }

    public function changePassword(Request $request){
        if (!(Hash::check($request->get('oldPassword'), Auth::user()->password))){
            return redirect()->back()->with("error", "Your current password does not match with the password you provided. Please try again.");
        }

        if (strcmp($request->get('oldPassword'), $request->get('newPassword')) == 0){
            return redirect()->back()->with("error", "New password cannot be the same as your current password. Please choose a different password.");
        }

        $request->validate([
            'oldPassword'   => 'required',
            'newPassword'   => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('newPassword'));
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully!");
    }
}
