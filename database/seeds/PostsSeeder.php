<?php

use Illuminate\Database\Seeder;
use App\Models\Posts;
use App\Models\Categories;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Posts::class, 20) -> make() -> each(function($post) {

            $category = Categories::inRandomOrder() -> first();

            $post -> category() -> associate($category);

            $post -> save();
        });
    }
}
