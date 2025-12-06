<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            // Polymorphic relation to any attachable model
            $table->morphs('attachable');
            // Storage details
            $table->string('disk')->default('public');
            $table->string('file_name');
            $table->string('original_name');
            $table->string('mime', 191)->nullable();
            $table->json('variants')->nullable(); // To store different variants like thumbnails
            $table->unsignedBigInteger('size')->default(0); // Size in bytes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
