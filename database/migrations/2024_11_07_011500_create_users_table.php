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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique(); // Thêm ràng buộc 'unique' cho email
            $table->integer('phone')->nullable();
            $table->text('address')->nullable(); // Dùng 'text' nếu cần nhiều ký tự hơn 255
            $table->string('password'); // Mật khẩu nên dùng 'string', không phải 'integer'
            $table->timestamp('birthday')->nullable();
            $table->string('img')->nullable(); 
            $table->integer('authority')->nullable()->index('auth_id');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
