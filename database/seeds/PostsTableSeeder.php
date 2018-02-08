<?php

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $cantidadPosts = 30;
        $cantidadTags = 15;

        factory(Post::class, $cantidadPosts)->create();
        factory(Category::class,$cantidadCategorias)->create();
        factory(Tag::class,$cantidadTags)->create();

        $user = new User();
        $user->name = 'Felipe';
        $user->email = 'miblog@miblog.test';
        $user->password = bcrypt('123456');
        $user->save();

    }
}
