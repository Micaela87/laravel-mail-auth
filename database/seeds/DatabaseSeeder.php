<?php

use Illuminate\Database\Seeder;
use App\Models\Posts;
use App\Models\Tags;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            PostsSeeder::class,
            TagsSeeder::class
        ]);
    }
}
