<?php

use App\Category;
use App\Post;
use App\Tag;
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
        Tag::truncate();

        Post::flushEventListeners();
        Category::flushEventListeners();
        Tag::flushEventListeners();

        $cantidadCategorias = 10;
        $cantidadPosts = 5;
        $cantidadTags = 3;

        factory(Post::class, $cantidadPosts)->create();
        factory(Category::class,$cantidadCategorias)->create();
        factory(Tag::class,$cantidadTags);

    }
}
