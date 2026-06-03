<?php

namespace App\Services\Admin;

use App\Models\Address;

class AddressService extends AbstractAdminCrudService
{
    protected function modelClass(): string
    {
        return Address::class;
    }

    protected function activeKey(): string
    {
        return 'addresses';
    }

    protected function routeKey(): string
    {
        return 'addresses';
    }

    protected function singleName(): string
    {
        return 'address';
    }
}
