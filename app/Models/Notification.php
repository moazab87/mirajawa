<?php

namespace App\Models;

use App\Traits\NotificationMessageTrait;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    use NotificationMessageTrait;

    const FILE_KEY          = 'image';
    const IMAGEPATH         = 'notifications';
    const FOLDER_NAME       = 'notifications';
    const SINGLE_NAME       = 'notification';

    public function getTypeAttribute()
    {
        return $this->data['type'];
    }

    public function getTitleAttribute()
    {
        return $this->getTitle($this->data,  defaultLang());
    }

    public function getBodyAttribute()
    {
        return $this->getBody($this->data,  defaultLang());
    }

    public function getSenderAttribute()
    {
        $def    = 'App\Models\\' . $this->data['sender_model'];
        $sender = $def::find($this->data['sender']);
        return [
            'name'   => $sender->name,
            'avatar' => $sender->avatar,
        ];
    }
}
