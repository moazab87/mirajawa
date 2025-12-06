<?php

namespace App\Models;

use App\Http\Resources\User\UserResource;
use App\Models\Chat\Room;
use App\Models\Chat\RoomMember;
use App\Notifications\SendVerificationCode;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Laravel\Sanctum\HasApiTokens;

class AuthBaseModel extends Authenticatable
{

    use Notifiable, UploadTrait, HasApiTokens, SoftDeletes, HasFactory;

    const IMAGEPATH = '';

    public $translatable = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }


    public function setImageAttribute($value)
    {
        define('UPLOADS_PATH', "uploads/" . static::IMAGEPATH);
        if (null != $value && is_file($value)) {

            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'], UPLOADS_PATH) : '';

            $file                       = $this->uploadAllTyps($value, UPLOADS_PATH, true);
            $this->attributes['image']  = $file['name'];
        }
    }

    public function getImageAttribute($value)
    {
        if (!$value) {
            return asset('admin/placeholders/profile.jpg');
        }
        return asset("uploads/" . static::IMAGEPATH . "/$value");
    }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function markAsActive()
    {
        $this->update(['code' => null, 'code_expire' => null, 'is_approved' => true]);
        return $this;
    }

    public function sendVerificationCode()
    {
        $this->update([
            'code'        => $this->activationCode(),
            'code_expire' => Carbon::now()->addMinute(),
        ]);
        $this->sendCodeAtEmail($this->code);

        class_basename($this);

        return ['user' => new UserResource($this)];
    }

    private function activationCode()
    {
        // return 1234;
        return mt_rand(1111, 9999);
    }

    public function sendCodeAtSms($code, $full_phone = null)
    {
        return false;
    }

    public function sendCodeAtEmail($code, $email = null): void
    {
        NotificationFacade::route('mail', $email ? $email : $this->email)
            ->notify(new SendVerificationCode(
                [
                    'title' => __('api.verification_code'),
                    'body'  => __('api.your_verification_code_is') . " $code",
                    'code'  => $code,
                    'email' => $email ? $email : $this->email
                ]
            ));
    }

    public function devices()
    {
        return $this->morphMany(Device::class, 'morph');
    }

    public function login()
    {
        $this->updateDevice();
        $this->updateLang();
        return $this->createToken(request()->device_type)->plainTextToken;
    }

    public function updateLang()
    {
        if (
            request()->header('Lang') != null
            && in_array(request()->header('Lang'), languages())
        ) {
            $this->update(['lang' => request()->header('Lang')]);
        } else {
            $this->update(['lang' => defaultLang()]);
        }
    }

    public function updateDevice()
    {
        if (request()->device_id) {
            $this->devices()->updateOrCreate([
                'device_id'   => request()->device_id,
                'device_type' => request()->device_type,
            ]);
        }
    }

    public function logout()
    {
        ($this->currentAccessToken() ? $this->currentAccessToken()->delete() : '');

        if (request()->device_id) {
            $device = $this->devices()->where('device_id', request()->device_id)->first();
            if ($device) {
                $device->delete();
            }
        }
        return true;
    }

    public function deleteAccount()
    {
        ($this->currentAccessToken() ? $this->currentAccessToken()->delete() : '');

        if (request()->device_id) {
            $device = $this->devices()->where('device_id', request()->device_id)->first();
            if ($device) {
                $device->delete();
            }
        }

        $this->delete();
        return true;
    }

    public function wallet()
    {
        return $this->morphOne(Wallet::class, 'walletable')->latest();
    }

    // transactions
    public function transactions()
    {
        return $this->hasManyThrough(WalletTransaction::class, Wallet::class, 'walletable_id', 'wallet_id', 'id', 'id')
            ->latest();
    }


    public function updateable()
    {
        return $this->morphMany(UserUpdate::class, 'updateable');
    }

    public function rooms()
    {
        return $this->morphMany(RoomMember::class, 'memberable');
    }

    public function ownRooms()
    {
        return $this->morphMany(Room::class, 'createable');
    }

    public function joinedRooms()
    {
        return $this->morphMany(RoomMember::class, 'memberable')
            ->with('room')
            ->get()
            ->sortByDesc('room.last_message_id')
            ->pluck('room');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')
            ->orderBy('created_at', 'desc');
    }

    public static function boot()
    {
        parent::boot();
        /* creating, created, updating, updated, deleting, deleted, forceDeleted, restored */

        static::deleted(function ($model) {
            $model->deleteFile($model->attributes['image'], self::IMAGEPATH);
        });

        static::created(function ($model) {
            $model->wallet()->create();
        });
    }
}
