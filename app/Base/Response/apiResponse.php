<?php

namespace App\Base\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait  apiResponse
{

    public function successMsg($msg, $code = JsonResponse::HTTP_OK) : JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => $msg,
        ],$code);
    }

    public function successfully($msg, $data, $code = JsonResponse::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => $msg,
            'data'    => $data
        ],$code);
    }

    public function successData($data, $code = JsonResponse::HTTP_OK) : JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => __('api.success'),
            'data'    => $data
        ],$code);
    }

    public function failed($msg, $errors , $code = JsonResponse::HTTP_NOT_FOUND) : JsonResponse
    {
        return response()->json([
            'status'        => false,
            'message'       => $msg,
            // 'errors'        => $errors

        ], $code);
    }

    public function blockedReturn($user)
    {
        $user->logout();
        return response()->json([
            'status'  => "blocked",
            'message' => __('api.blocked')
        ], 403);
    }

    public function phoneActivationReturn($user)
    {
        $user->sendVerificationCode();
        return $this->failed('needActive', [
            'phone' => $user->phone,
        ] , JsonResponse::HTTP_UNAUTHORIZED);
    }

    public function emailActivationReturn($user)
    {
        $user->sendVerificationCode();
        return $this->failed('needActive', [
            'email' => $user->email,
        ] , JsonResponse::HTTP_UNAUTHORIZED);
    }

    public function unauthenticatedReturn()
    {
        return $this->failed('unauthenticated', __('api.unauthenticated') , JsonResponse::HTTP_UNAUTHORIZED);
    }


}
