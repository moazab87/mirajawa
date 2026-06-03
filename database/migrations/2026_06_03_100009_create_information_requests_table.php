<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('information_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('company_name')->nullable();
            $table->string('phone', 30)->nullable();
            $table->text('message')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code', 50)->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('information_requests');
    }
};
