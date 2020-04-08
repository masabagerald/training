<?php

$factory->define(App\Training::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "region" => $faker->name,
        "venue" => $faker->name,
        "start_date" => $faker->date("d-m-Y", $max = 'now'),
        "end_date" => $faker->date("d-m-Y", $max = 'now'),
        "type_of_training" => $faker->name,
        "sponsor" => $faker->name,
        "comments" => $faker->name,
    ];
});
