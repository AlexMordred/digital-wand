<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Video::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return User::first()->id;
        },
        'file_path' => $faker->word . '.mkv',
        'sent' => false,
        'reviewed' => false,
    ];
});
