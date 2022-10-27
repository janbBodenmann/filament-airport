<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('commentable');
            //$table->string('commentable_type')->nullable();
            //$table->integer('commentable_id')->nullable();
            $table->text('comment');
            $table->string('topic')->nullable();
            $table->string('topic_key')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->json('has_read')->nullable();
            $table->json('has_highlighted')->nullable();
            $table->boolean('is_done')->default(false);
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
