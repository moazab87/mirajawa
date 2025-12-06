<?php

namespace App\Traits;

trait NotificationMessageTrait
{

    public function getTitle($data, $local = 'ar')
    {
        return trans('notification.title_' . $data['type'], $data, $local);
    }

    public function getBody(array $notification_data, $local = 'ar')
    {
        if ('admin_notify' == $notification_data['type']) {
            return $notification_data['body_' . $local];
        } else {
            return $this->transTypeToBody($notification_data, $local);
        }
    }

    private function transTypeToBody($notification_data, $local)
    {
        return trans('notification.body_' . $notification_data['type'], $notification_data, $local);
    }
}
