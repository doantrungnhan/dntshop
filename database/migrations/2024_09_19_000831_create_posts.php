
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id('postID');
            $table->string('title',500);
            $table->text('content');
            $table->string('slug');
            $table->string('image',500) ;
            $table->integer('views')->default(0);
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();


            $table->foreign('user_id')->references('userID')->on('users')->nullOnDelete();
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('post_id')->references('postID')->on('posts')->onDelete('cascade');
            $table->foreign('tag_id')->references('tagID')->on('tags')->onDelete('cascade');
            $table->primary(['post_id', 'tag_id']);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('post_tag');
    }
};
