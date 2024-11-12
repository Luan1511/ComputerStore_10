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
        Schema::table('carts', function (Blueprint $table) {
            $table->foreign(['customer_id'], 'cus')->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['laptop_id'], 'lap')->references(['id'])->on('laptops')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign('cus');
            $table->dropForeign('lap');
        });
    }
};
