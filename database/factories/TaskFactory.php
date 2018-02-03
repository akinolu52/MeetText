<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function ($faker) {
    return [
        'name' => $faker->title,
        'description' => $faker->Text,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
