<?php

use Faker\Generator as Faker;

$factory->define(App\Organization::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'uuid' => $faker->uuid,
    ];
});
