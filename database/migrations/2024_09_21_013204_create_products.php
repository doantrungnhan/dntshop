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
        Schema::create('products', function (Blueprint $table) {
            $table->id('productID');
            $table->string('product_code');
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->string('slug',500);
            $table->decimal('price');
            $table->decimal('discount')->nullable();
            $table->integer('views')->default(0);
            $table->boolean('featured')->default(false);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('categoryID')->on('categories')->nullOnDelete();
        });


        Schema::create('product_sizes',function (Blueprint $table) {
            $table->id('sizeID');
            $table->string('size_name');
        });

        Schema::create('product_colors',function (Blueprint $table) {
            $table->id('colorID');
            $table->string('color_name');
        });

        Schema::create('product_images',function (Blueprint $table) {
            $table->id('imageID');
            $table->string('image_url');
            $table->unsignedBigInteger('product_id');

            $table->foreign('product_id')->references('productID')->on('products')->cascadeOnDelete();
        });

        Schema::create('product_variants',function (Blueprint $table) {
            $table->id('variantID');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->integer('quantity');

            $table->foreign('product_id')->references('productID')->on('products')->cascadeOnDelete();
            $table->foreign('color_id')->references('colorID')->on('product_colors')->nullOnDelete();
            $table->foreign('size_id')->references('sizeID')->on('product_sizes')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_sizes');
        Schema::dropIfExists('product_colors');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_variants');
    }
};
