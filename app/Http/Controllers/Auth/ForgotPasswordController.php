<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\resetPasswordUpdateRequest;
use App\Jobs\SendAdminEmailJob;
use App\Models\Admin;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    // use SendsPasswordResetEmails;


    public function forgotPassword()
    {
        $admin = Admin::where('type', 'super_admin')->first();

        $update = $admin->updateable()->updateOrCreate(
            [
                'type' => 'password',
                'email' => $admin->email
            ],
            ['code' =>'']
        );
        dispatch(new SendAdminEmailJob($admin->email, ['code' => $update->code]));

        return view('AdminPanel.auth.forgotPassword',
            [
                'title' => 'Forgot Password',
                'email' => $admin->email
            ]);
    }

    public function forgotPasswordCheckCode(Request $request)
    {
        $digits = $request->digit_1 . $request->digit_2 . $request->digit_3 . $request->digit_4;

        $admin = Admin::where('type', 'super_admin')->first();
        $update = $admin->updateable()->where('type', 'password')->first();
        if ($update->code == $digits) {
            return redirect()->route('reset-password');
        }
        return redirect()->back()->with('error', 'Invalid Code');
    }

    public function resetPassword(Request $request)
    {
        $admin = Admin::where('type', 'super_admin')->first();
        return view('AdminPanel.auth.resetPassword',
            [
                'title' => 'Reset Password',
                'email' => $admin->email,
            ]);
    }

    public function resetPasswordUpdate(resetPasswordUpdateRequest $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if($admin->updateable()->where('type', 'password')->first()->code != '' &&
            $admin->updateable()->where('type', 'password')->first()->email == $request->email){
            $update = $admin->updateable()->where('type', 'password')->first();
            $update->delete();
            $admin->update(['password' => $request->password]);
            return redirect()->route('login');
        }

        return redirect()->back()->with('error', 'Invalid Email');
    }

}
