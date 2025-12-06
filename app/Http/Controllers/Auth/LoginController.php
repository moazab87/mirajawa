<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(LoginRequest $request)
    {
        $input = $request->validated();
        $remember = 1 == $request->remember ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $input['email'], 'password' => $input['password'],
            'is_blocked' => '0'], $remember))
        {
            return redirect()->route('admin.admin.index');
        } else {
            session()->put('faild', trans('auth.failed'));
            return redirect()->back()->withInput();
        }
    }
    public function showLoginForm()
    {
        $title = trans('common.Sign in');
        return view('AdminPanel.auth.login', [
            'active' => '',
        ], compact('title'));
    }
    protected function loggedOut(Request $request)
    {
        return redirect()->route('login');
    }
}
