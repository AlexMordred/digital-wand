<?php

use Faker\Generator as Faker;

$factory->define(App\Video::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'file_path' => $faker->word . '.mkv',
        'original_filename' => $faker->word . '.mkv',
        'sent' => false,
        'reviewed' => false,
    ];
});
