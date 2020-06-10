<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TelegramUser;

class ControllerLoginUser extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function username()
{
    return 'username';
}

    public function login(Request $req) {

        $validation = $req->validate([
            'username' => 'required',
            'password' => 'required',
          ]);
    
          $credentials = $req->only('username', 'password');
    
          if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
          }
          return view('auth.login');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
