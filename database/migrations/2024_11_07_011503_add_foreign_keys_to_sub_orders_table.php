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
        Schema::table('sub_orders', function (Blueprint $table) {
            $table->foreign(['laptop_id'], 'laptop_id')->references(['id'])->on('laptops')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['main_order_id'], 'order_id')->references(['id'])->on('orders')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_orders', function (Blueprint $table) {
            $table->dropForeign('laptop_id');
            $table->dropForeign('order_id');
        });
    }
};
