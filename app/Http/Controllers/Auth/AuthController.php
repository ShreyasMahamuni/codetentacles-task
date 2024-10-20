<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Yoeunes\Toastr\Facades\Toastr;

class AuthController extends Controller
{
    public function __construct()
    {
        // 
    }

    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $r)
    {
        $r->validate([
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            ],
            'password' => [
                'required',
                'min:6',
                'max:18'
            ]
        ]);

        try {
            $user = User::where('email', $r->email)->first();
            if ($user && Hash::check($r->password, $user->password)) {
                Auth::login($user);
                Toastr::success('Login successfully.', 'Success');
                return redirect('/product/create');
            }
        } catch (\Exception $ex) {
            Toastr::error($ex->getMessage(), 'Exception');
            Log::error($ex->getMessage());
            return redirect('/');
        }
    }

    public function logout(Request $r)
    {
        try {
            Auth::logout();
            $r->session()->flush();
            Toastr::success('Logout successfully.', 'Success');
            return redirect('/');
        } catch (\Exception $ex) {
            Toastr::error($ex->getMessage(), 'Exception');
            Log::error('failed to logout');
            return redirect()->back();
        }
    }
}
