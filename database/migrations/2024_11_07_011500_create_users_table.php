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
            $table->integer('id', true);
            $table->string('name');
            $table->string('email');
            $table->integer('phone')->nullable();
            $table->string('address', 526)->nullable();
            $table->integer('password');
            $table->timestamp('birthday')->nullable();
            $table->string('img', 526)->nullable();
            $table->integer('authority')->nullable()->index('auth_id');
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
