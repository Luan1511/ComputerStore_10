<?php

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
        Schema::create('images_laptop', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('image_url', 526)->nullable();
            $table->integer('id_laptop')->nullable()->index('image_laptop');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images_laptop');
    }
};
