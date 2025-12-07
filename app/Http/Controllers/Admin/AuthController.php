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
        // Preserve the current language before invalidating session
        $currentLang = $request->session()->get('Lang');
        $allowedLanguages = ['en', 'ja'];
        // Ensure the language is valid, default to 'en' if not
        if (!in_array($currentLang, $allowedLanguages)) {
            $currentLang = 'en';
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Restore the language preference after session regeneration
        if ($currentLang) {
            $request->session()->put('Lang', $currentLang);
        }

        return redirect()->route('admin.show.login');
    }
}
