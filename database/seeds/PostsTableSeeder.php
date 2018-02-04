<?php

use App\Category;
use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        Category::truncate();

        Post::flushEventListeners();
        Category::flushEventListeners();

        $cantidadCategorias = 10;
        $cantidadPosts = 3;

        factory(Post::class, $cantidadPosts)->create();
        factory(Category::class,$cantidadCategorias)->create();

    }
}
