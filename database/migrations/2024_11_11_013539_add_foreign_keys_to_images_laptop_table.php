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
        Schema::table('images_laptop', function (Blueprint $table) {
            $table->foreign(['id_laptop'], 'image_laptop')->references(['id'])->on('laptops')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images_laptop', function (Blueprint $table) {
            $table->dropForeign('image_laptop');
        });
    }
};
