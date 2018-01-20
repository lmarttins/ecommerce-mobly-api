<?php

use Faker\Generator as Faker;

$factory->define(EcommerceMobly\Domains\Products\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(5),
        'description' => $faker->text(),
    ];
});
