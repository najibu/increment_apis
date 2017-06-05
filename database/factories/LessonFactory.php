<?php 

$factory->define(App\Lesson::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(5),
        'body' => $faker->paragraph(4),
    ];
    
});