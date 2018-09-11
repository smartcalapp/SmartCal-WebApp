<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'name' => $faker->bs,
        'published' => $faker->boolean(80),
        'description' => $faker->text,
        'tags' => '["test", "test2"]',
        'start_time' => $faker->unixTime,
        'end_time' => $faker->unixTime,
    ];
});
