<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\AdminUpdateRequest;
use App\Models\User;
use App\Services\Admin\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    //
    public function index(DashboardService $dashboardService)
    {
        return view('admin.dashboard.index', $dashboardService->getDashboardData());
    }

    public function edit()
    {
        return view('admin.dashboard.my-profile', [
            'active'    => 'my-profile',
            'title'     => trans('admin.profile'),
        ]);
    }

    public function update(AdminUpdateRequest $request)
    {
        $update = auth('admin')->user()->update($request->validated());
        if ($update) {
            return redirect()->back()
                ->with('success', trans('admin.successMessageText'));
        } else {
            return redirect()->back()
                ->with('faild', trans('admin.faildMessageText'));
        }
    }

    public function EditPassword()
    {
        return view('admin.dashboard.my-password', [
            'active' => 'my-password',
            'title' => trans('admin.password'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('admin.Security')
                ]
            ]
        ]);
    }

    public function updatePassword(Request $request)
    {
        $data = $request->except(['_token', 'password_confirmation']);

        $rules = [
            'password' => 'required|confirmed',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('faild', trans('admin.faildMessageText'));
        }

        $update = auth()->user()->update($data);

        if ($update) {
            return redirect()->back()
                ->with('success', trans('admin.successMessageText'));
        } else {
            return redirect()->back()
                ->with('faild', trans('admin.faildMessageText'));
        }
    }


    public function notificationDetails($id)
    {
        $notification = DatabaseNotification::find($id);
        $notification->markAsRead();
        if (in_array($notification['type'], ['App\Notifications\OrderNotification'])) {
            return redirect()->route('orders.show', ['order' => $notification->data['order']['id']]);
        }
        return redirect()->back();
    }

    public function readAllNotifications()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }

    public function  setDevice(Request $request)
    {
        if ($request->ajax()) {
            $guard = $request->guard;

            if (Auth::guard($guard)->check()) {
                $currentAuthGuard = Auth::guard($guard)->user();
                $currentAuthGuard->devices()->updateOrCreate(
                    [
                        'device_id'   => $request->device_id,
                        'device_type' => $request->device_type,
                    ],
                    [
                        'device_id'   => $request->device_id,
                        'device_type' => $request->device_type,
                    ]
                );
                Session::put($guard . '_device_id', $request->device_id);
            }
        }
    }

}
