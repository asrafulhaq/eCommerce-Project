<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title') -> unique();
            $table->unsignedInteger('user_id');
            $table->string('slug');
            $table->string('featured') -> nullable();
            $table->longText('content');
            $table->boolean('status') -> default(true);
            $table->boolean('trash') -> default(false);
            $table->unsignedInteger('views') -> default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
