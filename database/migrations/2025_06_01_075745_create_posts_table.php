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
            $table->id('postId'); 
            $table->foreignId('user_id')
                  ->constrained('users') 
                  ->onDelete('cascade'); 
            $table->string('content', 280);
            $table->integer('likeCount')->default(0);
            $table->integer('repostCount')->default(0);
            $table->integer('bookmarkCount')->default(0);
            $table->integer('replyCount')->default(0);
            $table->timestamp('created_at')->useCurrent(); 

            // parent_post_id untuk reply 
            $table->foreignId('parent_post_id')
                  ->nullable() 
                  ->constrained('posts', 'postId') 
                  ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};