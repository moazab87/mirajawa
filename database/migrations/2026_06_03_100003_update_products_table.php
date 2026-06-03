<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->json('packaging')->nullable()->after('description');
            $table->json('country_of_origin')->nullable();
            $table->json('how_to_use')->nullable();
            $table->json('storage_conditions')->nullable();
            $table->json('expiry_date_text')->nullable();
            $table->json('harvest_season')->nullable();
            $table->json('notes')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->after('notes');
            $table->foreignId('product_group_id')->nullable()->after('category_id')->constrained('product_groups')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['product_group_id']);
            $table->dropColumn([
                'packaging',
                'country_of_origin',
                'how_to_use',
                'storage_conditions',
                'expiry_date_text',
                'harvest_season',
                'notes',
                'status',
                'product_group_id',
            ]);
        });
    }
};
