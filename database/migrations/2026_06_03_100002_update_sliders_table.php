<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->json('title')->nullable()->after('id');
            $table->json('description')->nullable()->after('title');
            $table->unsignedTinyInteger('status')->default(1)->after('description');
        });

        DB::table('sliders')->update([
            'status' => DB::raw('CASE WHEN is_active = 1 THEN 1 ELSE 0 END'),
        ]);

        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
        });

        DB::table('sliders')->update([
            'is_active' => DB::raw('CASE WHEN status = 1 THEN 1 ELSE 0 END'),
        ]);

        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'status']);
        });
    }
};
