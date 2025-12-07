<?php

namespace Database\Seeders;

use App\Enums\RoleTypeEnum;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixedPageSeeder extends Seeder
{
    public function run(): void
    {
        $owner = User::query()->first();

        if (! $owner) {
            $this->command->warn('⚠️ No users found. Skipping FixedPageSeeder.');
            return;
        }

        DB::table('fixed_pages')->insertGetId([
            'name'        => json_encode(['en' => 'About Us', 'ja' => '私たちについて']),
            'content' => json_encode(['en' => 'This is the about us page content.', 'ja' => 'これは私たちについてのページのコンテンツです。']),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        
        DB::table('fixed_pages')->insertGetId([
            'name'        => json_encode(['en' => 'Privacy Policy', 'ja' => 'プライバシーポリシー']),
            'content' => json_encode(['en' => 'This is the privacy policy page content.', 'ja' => 'これはプライバシーポリシーのページのコンテンツです。']),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        DB::table('fixed_pages')->insertGetId([
            'name'        => json_encode(['en' => 'Terms of Service', 'ja' => '利用規約']),
            'content' => json_encode(['en' => 'This is the terms of service page content.', 'ja' => 'これは利用規約のページのコンテンツです。']),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
