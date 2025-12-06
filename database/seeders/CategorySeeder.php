<?php

namespace Database\Seeders;

use App\Enums\RoleTypeEnum;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $owner = User::query()->first();

        if (! $owner) {
            $this->command->warn('⚠️ No users found. Skipping CategorySeeder.');
            return;
        }

        DB::table('categories')->insertGetId([
            'name'        => json_encode(['en' => 'Market Category', 'ja' => '市場カテゴリ']),
            'description' => json_encode(['en' => 'The main default category for the system.', 'ja' => 'システムのデフォルトカテゴリです。']),
            // 'leader_id'   => $owner->id,
            // 'color'       => '#2563eb',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
