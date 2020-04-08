<?php

$factory->define(App\Designation::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
