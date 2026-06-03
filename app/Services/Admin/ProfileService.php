<?php

namespace App\Services\Admin;

use App\Models\Profile;

class ProfileService extends AbstractAdminCrudService
{
    protected function modelClass(): string
    {
        return Profile::class;
    }

    protected function activeKey(): string
    {
        return 'profiles';
    }

    protected function routeKey(): string
    {
        return 'profiles';
    }

    protected function singleName(): string
    {
        return 'profile';
    }
}
