<?php
/**
 * Created by PhpStorm.
 * User: amrsharkas
 * Date: 12/06/2020
 * Time: 11:20 AM
 */


use Illuminate\Support\Str;
use sharkas\Press\Models\Post;


$factory->define(Post::class,function(Faker\Generator $faker){

    return[
        'identifier' => Str::random(),
        'slug' => Str::slug($faker->sentence),
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'extra' => json_encode(['test' => 'value'])
    ];

});