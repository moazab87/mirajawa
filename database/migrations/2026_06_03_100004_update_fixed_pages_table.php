<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fixed_pages', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('id');
            $table->json('sub_title')->nullable()->after('name');
            $table->json('description')->nullable()->after('sub_title');
            $table->string('image')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
        });

        if (Schema::hasColumn('fixed_pages', 'content')) {
            DB::statement('UPDATE fixed_pages SET description = content WHERE description IS NULL');
            Schema::table('fixed_pages', function (Blueprint $table) {
                $table->dropColumn('content');
            });
        }
    }

    public function down(): void
    {
        Schema::table('fixed_pages', function (Blueprint $table) {
            $table->json('content')->nullable();
        });

        DB::statement('UPDATE fixed_pages SET content = description WHERE content IS NULL');

        Schema::table('fixed_pages', function (Blueprint $table) {
            $table->dropColumn(['slug', 'sub_title', 'description', 'image', 'status']);
        });
    }
};
