<?php

namespace App\Http\Controllers\Admin;

use App\Base\Repositories\BaseCrudRepository;
use App\Http\Requests\Admin\Users\StoreUsersRequest;
use App\Http\Requests\Admin\Users\UpdateUsersRequest;
use App\Models\User;

class UsersController extends BaseCrudRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->setData();
    }

    public function setData()
    {
        $this->model            = new User();
        $this->storeRequest     = StoreUsersRequest::class;
        $this->updateRequest    = UpdateUsersRequest::class;
    }

    public function block(User $user, $action)
    {
        $update = $user->update(['is_blocked' => $action]);
        if ($update) {
            return redirect()->back()
                ->with('success', trans('common.successMessageText'));
        } else {
            return redirect()->back()
                ->with('faild', trans('common.faildMessageText'));
        }
    }
}
