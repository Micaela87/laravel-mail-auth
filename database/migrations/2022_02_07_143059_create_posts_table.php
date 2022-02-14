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
            $table -> string('title') -> unique();
            $table -> string('author');
            $table -> text('content');
            $table -> date('release_date');
            $table -> tinyInteger('rating') -> unsigned() -> nullable();
            $table->foreignId('category_id') -> constrained('categories');
            // $table -> foreign('category_id') -> references('id') -> on('categories');
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
