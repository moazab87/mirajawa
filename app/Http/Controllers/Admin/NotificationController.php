<?php

namespace App\Http\Controllers\Admin;

use App\Base\Repositories\BaseCrudRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notification\NotificationRequest;
use App\Models\Notification;
use App\Traits\FirebaseTrait;

class NotificationController extends Controller
{
    use FirebaseTrait;

    public function index()
    {

        $models = auth()->user()->notifications()
            ->orderBy('id', 'desc')
            ->paginate(20);
        // mark all notifications as read
        auth()->user()->unreadNotifications->markAsRead();
        return view("admin.notifications.index", [
            'title'         => trans("route.notifications.index"),
            'singleName'    => 'notification',
            'route'         => route("admin.notifications.index"),
            'deleteRoute'   => "notifications.destroy",
        ], compact('models'));
    }
}
