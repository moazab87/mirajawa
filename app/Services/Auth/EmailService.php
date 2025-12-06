<?php


namespace App\Services\Auth;

use App\Notifications\SendVerificationCode;


class EmailService
{

    public function sendCode($user)
    {
        $code = $user->updateable->last()->code;
        $data = [
            'title' => 'Verification Code',
            'body'  => 'Your verification code is: ' . $code,
            'code'  => $code,
            'email' => $user->email
        ];

        $user->notify(new SendVerificationCode($data));
    }

}
