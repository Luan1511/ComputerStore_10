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
        Schema::create('laptops', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->integer('brand_id')->index('brand_id');
            $table->string('processor')->comment('vi xử lý');
            $table->string('ram', 64);
            $table->string('rom', 64);
            $table->decimal('screen_size', 4, 1);
            $table->string('graphics_card')->comment('card đồ họa');
            $table->string('battery');
            $table->string('os')->comment('hệ điều hành');
            $table->decimal('price', 10);
            $table->integer('stock')->comment('số lượng tồn kho');
            $table->string('description')->nullable();
            $table->timestamp('created_at')->nullable()->comment('time tạo');
            $table->timestamp('updated_at')->nullable()->comment('time update');
            $table->string('img', 526)->nullable();
            $table->decimal('rating', 1, 1)->nullable()->comment('đánh giá');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptops');
    }
};
