<?php

namespace App\Services\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleService
{
    private function dropdowns(): array
    {
        $permissions = Permission::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();

        return compact('permissions');
    }

    private function basePageData(): array
    {
        return [
            'active'     => 'roles',
            'title'      => __('route.roles.index'),
            'singleName' => 'role',
            'route'      => route('admin.roles.index'),
        ];
    }

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
        return $this->renderForm('admin.roles.create', [
            'subTitle'   => __('route.roles.create'),
            'storeRoute' => route('admin.roles.store'),
        ]);
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $role = Role::create($request);
            if (isset($request['permissions'])) {
                $role->givePermissionTo($request['permissions']);
            }
            DB::commit();
            return redirect()->route('admin.roles.index')
                ->with('success', __('admin.successMessageText'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', __('admin.errorMessageText'));
        }
    }

    public function edit(Role $role): View
    {
        return $this->renderForm('admin.roles.edit', [
            'subTitle'    => __('route.roles.edit'),
            'updateRoute' => route('admin.roles.update', $role->id),
            'model'       => $role->loadMissing(['permissions:id,name']),
        ]);
    }

    public function update(Role $role, $request)
    {
        try {
            DB::beginTransaction();
            $role->update($request);
            if (isset($request['permissions'])) {
                $role->syncPermissions($request['permissions']);
            } else {
                $role->syncPermissions([]);
            }
            DB::commit();
            return redirect()->route('admin.roles.index')
                ->with('success', __('admin.editSuccessMessageText'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', __('admin.errorMessageText'));
        }
    }
}
