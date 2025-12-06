<?php

namespace App\Services\Admin;

use App\Models\Admin;
use App\Models\Shipment;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminService
{
    /**
     * Shared dropdowns (cached) for create/edit forms.
     */
    private function dropdowns(): array
    {
        $roles = Role::query()
                ->select('id', 'name')
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray();

        return compact('roles');
    }

    /**
     * Static page meta shared between create/edit.
     */
    private function basePageData(): array
    {
        return [
            'active'     => 'admins',
            'title'      => __('route.admins.index'),
            'singleName' => 'admin',
            'route'      => route('admin.admins.index'),
        ];
    }

    /**
     * Helper to render create/edit with merged data.
     */
    private function renderForm(string $view, array $data = []): View
    {
        return view($view, array_merge(
            $this->basePageData(),
            $this->dropdowns(),
            $data
        ));
    }

    public function create(): View
    {
        return $this->renderForm('admin.admins.create', [
            'subTitle'   => __('route.admins.create'),
            'storeRoute' => route('admin.admins.store'),
        ]);
    }

    public function store($request)
    {
        try {
            DB::transaction(function () use ($request) {
                $admin = Admin::create($request);
                if (isset($request['role'])) {
                    $admin->assignRole($request['role']);
                }
            });
            return redirect()->route('admin.admins.index')
                ->with('success', __('admin.successMessageText'));
        } catch (\Exception $e) {
            logError($e);
            return redirect()->back()
                ->with('failed', __('admin.errorMessageText'));
        }
    }

    public function edit(Admin $admin): View
    {
        return $this->renderForm('admin.admins.edit', [
            'subTitle'    => __('route.admins.edit'),
            'updateRoute' => route('admin.admins.update', $admin->id),
            'model'       => $admin->loadMissing(['roles:id,name']),
        ]);
    }

    public function update(Admin $admin, $request)
    {
        try {
            DB::transaction(function () use ($admin, $request) {
                $admin->update($request);
                $admin->syncRoles($request['role']);
            });
            return redirect()->route('admin.admins.index')
                ->with('success', __('admin.successMessageText'));
        } catch (\Exception $e) {
            logError($e);
            return redirect()->back()
                ->with('failed', __('admin.errorMessageText'));
        }
    }
}
