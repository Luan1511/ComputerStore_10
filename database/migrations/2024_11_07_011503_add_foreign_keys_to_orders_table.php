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
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign(['customer_id'], 'cus_id')->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['payment_method'], 'pay_method_id')->references(['id'])->on('payment_method')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('cus_id');
            $table->dropForeign('pay_method_id');
        });
    }
};
