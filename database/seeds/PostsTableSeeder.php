<?php

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        Role::truncate();
        Permission::Truncate();

        Post::flushEventListeners();
        Category::flushEventListeners();
        Tag::flushEventListeners();

        $cantidadCategorias = 10;
        $cantidadPosts = 30;
        $cantidadTags = 15;

        $adminRole = Role::create(['name' => 'Admin']);
        $writerRole = Role::create(['name' => 'Writer']);

        $viewPostsPermission = Permission::create(['name' => 'View posts']);
        $createPostsPermission = Permission::create(['name' => 'Create posts']);
        $updatePostsPermission = Permission::create(['name' => 'Update posts']);
        $deletePostsPermission = Permission::create(['name' => 'Delete posts']);

        $admin = new User();
        $admin->name = 'Felipe';
        $admin->email = 'miblog@miblog.test';
        $admin->password = bcrypt('123456');
        $admin->save();

        $admin->assignRole($adminRole);

        $writer = new User();
        $writer->name = 'Antonio';
        $writer->email = 'miblog2@miblog.test';
        $writer->password = bcrypt('123456');
        $writer->save();

        $writer->assignRole($writerRole);


        factory(Category::class,$cantidadCategorias)->create();
        factory(Post::class, $cantidadPosts)->create();
        factory(Tag::class,$cantidadTags)->create();

    }
}
