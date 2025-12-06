<?php

namespace App\Services\Profile;

use App\Http\Resources\AddressResource;
use App\Http\Resources\CityResource;
use App\Models\Address;
use App\Models\City;

class AddressService
{
    public function index()
    {
        return AddressResource::collection(
                Address::where('user_id', auth()->id())
                    ->orderBy('id', 'desc')
                    ->get());
    }

    public function store($request)
    {
        try {
            auth()->user()->addresses()->update(['is_default' => 0]);
            auth()->user()->addresses()->create($request);
            return ['key' => 'success', 'msg' => __('api.AddressAddedSuccessfully'), 'data' => $this->index()];
        } catch (\Exception $e) {
            return ['key' => 'fail', 'msg' => $e->getMessage(), 'errors' => $e->getLine()];
        }
    }

    public function update($request, $address)
    {
        try {
            $address->update($request);
            return ['key' => 'success', 'msg' => __('api.AddressUpdatedSuccessfully'), 'data' => $this->index()];
        } catch (\Exception $e) {
            return ['key' => 'fail', 'msg' => $e->getMessage(), 'errors' => $e->getLine()];
        }
    }

    public function destroy($address)
    {
        try {
            $address->delete();
            return ['key' => 'success', 'msg' => __('api.AddressDeletedSuccessfully'), 'data' => $this->index()];
        } catch (\Exception $e) {
            return ['key' => 'fail', 'msg' => $e->getMessage(), 'errors' => $e->getLine()];
        }
    }

}
