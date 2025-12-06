<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('admin.auth.login', [
            'title' => __('admin.admin_login_page')
        ]);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return response()->json(['status' => 'login', 'url' => route('admin.admin.index'), 'message' => __('admin.login_successfully_logged')]);
        }
        return response()->json(['status' => 0, 'message' => __('admin.InvalidEmailOrPassword')]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
