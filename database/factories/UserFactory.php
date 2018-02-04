<?php

use App\Category;
use App\Post;
use Carbon\Carbon;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$factory->define(Post::class, function (Faker $faker) {

    return [
        'title' => $faker->words(3,true),
        'excerpt' => $faker->paragraph(1),
        'body' => $faker->paragraph(3),
        'published_at' => Carbon::now()->subDay($faker->numberBetween(1,5))->subHour($faker->numberBetween(1,10)),
        'category_id' => $faker->numberBetween(1,10)
    ];
});

$factory->define(Category::class, function (Faker $faker){

    return [
        'name' => $faker->word
    ];

});