<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class DashboardLang
{
    public static function moduleKey(?string $routeOrFolder): string
    {
        $map = [
            'fixedPages'           => 'static_pages',
            'productGroups'        => 'product_groups',
            'contactMessages'      => 'contact_messages',
            'informationRequests'  => 'information_requests',
            'informationBlocks'    => 'information',
            'contactInformation'   => 'contact_information',
            'settings'             => 'settings',
        ];

        if (!$routeOrFolder) {
            return 'common';
        }

        return $map[$routeOrFolder] ?? Str::snake($routeOrFolder);
    }

    public static function trans(string $routeOrFolder, string $suffix): string
    {
        $key = 'dashboard.' . self::moduleKey($routeOrFolder) . '.' . $suffix;

        return __($key);
    }
}
