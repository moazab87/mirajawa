<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AuthService
{
    public function register($request)
    {
        $user = User::create($request);
        $user->sendVerificationCode();

        return [
            'key' => true,
            'msg' => __('api.succesfully_registered'),
        ];
    }

    public function activate($request)
    {
        $user = User::where([
            'email' => $request['email'],
        ])->first();

        $user->markAsActive();

        return [
            'key' => true,
            'msg' => __('api.activated'),
            'user' => $user->refresh()
        ];
    }

    public function resendCode($request)
    {
        $user = User::where([
            'email' => $request['email'],
        ])->first();

        $user->sendVerificationCode();

        // Return the success message and the updated user data
        return [
            'key' => true,
            'msg' => __('api.code_re_send'),
            'user' => $user->refresh()
        ];
    }

    public function login($request)
    {
        $user = User::where(['email' => $request['email']])->first();
        // If password is incorrect, return failure
        if (!Hash::check($request['password'], $user->password)) {
            return [
                'key'  => false,
                'msg'  => __('api.incorrect_email_or_password'),
                'user' => []
            ];
        }
        // If all checks pass, return success
        return [
            'key' => true,
            'msg' => __('api.signed'),
            'user' => $user
        ];
    }

    public function forgetPasswordSendCode($request)
    {
        $request['user']->updateable()->updateOrCreate(
            [
                'type'  => 'password',
                'email' => $request['email'],
            ],
            ['code' => '']
        );

        return ['key' => true, 'msg' => __('api.success'), 'user' => $request['user']->refresh()];
    }

    public function resetPassword($request)
    {
        $user = $request['user'];

        $user->updateable()->where(['type' => 'password', 'email' => $request['email']])
            ->delete();

        $user->logout();
        $user->update(['password' => $request['password']]);
        // Return success message
        return [
            'key' => true,
            'msg' => __('api.password_changed')
        ];
    }

    public function updateProfile($request)
    {
        auth()->user()->update($request);

        return [
            'key'  => true,
            'msg'  => __('api.account_updated'),
            'user' => auth()->user()->refresh()
        ];
    }

    public function socialAuth($request)
    {
        DB::beginTransaction();
        try {

            $user = User::where([
                'provider_id'   => $request['provider_id'],
                'provider'      => $request['provider'],
                'email'         => $request['email']
            ])->first();

            if ($user) {
                return [
                    'key' => true,
                    'msg' => __('api.signed'),
                    'user' => $user->refresh()
                ];
            }

            $request += [
                'password'      => Hash::make($request['provider_id']),
                'is_approved'   => true
            ];
            $user = User::create($request);
            DB::commit();

            (isset($request['referral_id'])) ? $this->participationPoints($request['referral_id'], $user->refresh()) : null;

            return [
                'key'   => true,
                'msg'   => __('api.registered,youGetPointsFromYourFriend'),
                'user'  => $user->refresh()
            ];
        } catch (\Exception $e) {
            DB::rollback();
            return [
                'key'   => false,
                'msg'   => $e->getMessage(),
                'user'  => []
            ];
        }
    }
}
