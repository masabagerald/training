<?php

$factory->define(App\Participant::class, function (Faker\Generator $faker) {
    return [
        "first_name" => $faker->name,
        "middle_name" => $faker->name,
        "last_name" => $faker->name,
        "mobile" => $faker->name,
        "sex" => collect(["male","female",])->random(),
        "dob" => $faker->date("d-m-Y", $max = 'now'),
        "health_facility" => $faker->name,
        "postal_address" => $faker->name,
        "district" => $faker->name,
        "subcounty" => $faker->name,
        "parish" => $faker->name,
        "job_title_id" => factory('App\Designation')->create(),
        "profession" => $faker->name,
        "previous_training" => collect(["1","0",])->random(),
        "education_level" => collect(["1","2","3","4","5","6",])->random(),
        "comments" => $faker->name,
    ];
});
