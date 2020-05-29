<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AreaAgentLevelModel;
use Faker\Generator as Faker;

$factory->define(AreaAgentLevelModel::class, function (Faker $faker) {
    return [
        'site_id' => $faker->randomDigit,
        'name' => $faker->name,
        'status' => rand(0,1),
    ];
});
