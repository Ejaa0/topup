<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('user_name');      // HARUS string, bukan integer
            $table->string('game_id');
            $table->string('server_id');
            $table->string('phone');
            $table->enum('status', ['pending','done']);
            $table->integer('quantity');
            $table->integer('total_price');
            $table->timestamps();
        
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
