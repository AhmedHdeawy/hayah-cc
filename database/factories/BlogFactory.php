<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'image' => $faker->image(),
        'ar'    =>  [
            'title' =>  $faker->sentence(),
            'content' =>  $faker->sentence(120),
        ],
        'en'    =>  [
            'title' =>  $faker->sentence(),
            'content' =>  $faker->sentence(120),
        ],
    ];
});
