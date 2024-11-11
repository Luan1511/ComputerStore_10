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
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('customer_id')->index('cus_id');
            $table->integer('status');
            $table->integer('payment_method')->index('pay_method_id');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->decimal('laptop_cost', 10);
            $table->integer('quantity');
            $table->decimal('total_cost', 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
