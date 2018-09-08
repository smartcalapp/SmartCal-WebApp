<?php

use Faker\Generator as Faker;

$factory->define(App\Site::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'url' => $faker->word,
        'uuid' => $faker->unique()->uuid
    ];
});
