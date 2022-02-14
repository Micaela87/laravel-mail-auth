<?php

use Illuminate\Database\Seeder;
use App\Models\Tags;
use App\Models\Posts;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tags::class, 10) -> create() -> each(function($tag) {

            $posts = Posts::inRandomOrder() -> limit(rand(0, 5)) -> get();

            $tag -> posts() -> attach($posts);

            $tag -> save();
        });
    }
}
