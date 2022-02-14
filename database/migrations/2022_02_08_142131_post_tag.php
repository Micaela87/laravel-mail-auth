<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PostTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_tags', function (Blueprint $table) {

            $table -> id();

            $table -> foreignId('posts_id') -> constrained('posts');
            $table -> foreignId('tags_id') -> constrained('tags');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('posts_tags', function (Blueprint $table) {

            $table -> dropForeign('posts_tags_posts_id_foreign');
            $table -> dropForeign('posts_tags_tags_id_foreign');

        });
    }
}
