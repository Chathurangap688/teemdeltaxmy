<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class AdminLoginController extends Controller
{
    public function showLogin(){
        return view('admin.auth.login');
    }

    // log as admin
    public function login(){
        $this->validate(request(), [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if(!auth()->attempt(request(['email', 'password'], request('remember'))) ){
            return redirect()->back()->withErrors([
                'message' => 'Credentials not match'
            ]);
        }

        if (auth()->user()->role != 'admin'){
            auth()->logout();

            return redirect()->back()->withErrors([
                'message' => 'Unauthorized Access'
            ])->setStatusCode(501);
        }

        return redirect('/admin');
    }

    public function logout(){
        auth()->logout();

        return redirect('/admin/login');
    }

    static function routes(){
        Route::get('admin/login', 'Auth\AdminLoginController@showLogin');
        Route::post('admin/login', 'Auth\AdminLoginController@login');
    }
}
