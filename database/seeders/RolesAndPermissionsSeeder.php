<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // choose the guard your Admins use
        $guard = 'admin';

        // get admin routes
        $routes = collect(Route::getRoutes())
            ->filter(
                fn($route) =>
                str_starts_with($route->getName() ?? '', 'admin.') ||
                    str_contains($route->uri(), 'admin')
            );

        $permissions = [];

        foreach ($routes as $route) {
            $name = $route->getName();
            if (!$name) {
                continue;
            }

            // remove leading "admin." from route names
            if (str_starts_with($name, 'admin.')) {
                $name = substr($name, strlen('admin.'));
            }

            $permissions[] = $name;
        }

        // unique
        $permissions = array_values(array_unique($permissions));


        // create permissions with the *admin* guard
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate([
                'name'       => $permissionName,
                'guard_name' => $guard,
            ]);
        }

        // create role with the *same* guard
        $adminRole = Role::firstOrCreate([
            'name'       => 'super_admin',
            'guard_name' => $guard,
        ]);

        // give all permissions to super_admin
        $adminRole->givePermissionTo(Permission::where('guard_name', $guard)->get());

        // assign to your admin user
        $admin = Admin::where('type', 'super_admin')->first();
        if ($admin) {
            $admin->assignRole($adminRole);
        }
    }
}
