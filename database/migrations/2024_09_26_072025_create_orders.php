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
            $table->id('orderID');
            $table->string('order_code',100)->unique();
            $table->decimal('total_amount',10,2);
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->enum('payment_method',['cash','bank_transfer','momo'])->default('cash');
            $table->enum('payment_status',['pending', 'completed', 'failed', 'refunded','paid on delivery'])->default('pending');
            $table->enum('order_status',['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'])->default('pending');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('promotion_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('userID')->on('users')->nullOnDelete();
            $table->foreign('promotion_id')->references('promotionID')->on('promotions')->nullOnDelete();
        });


        Schema::create('order_detail', function (Blueprint $table){
            $table->id('order_detailID');
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->unsignedBigInteger('order_id');
            $table->integer('quantity');
            $table->decimal('price',10,2);

            $table->foreign('variant_id')->references('variantID')->on('product_variants')->nullOnDelete();
            $table->foreign('order_id')->references('orderID')->on('orders')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_detail');
    }
};
