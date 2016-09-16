<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'client_id' => 1,
        'fax_id' => 1,
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => Hash::make('NoPassword'),
        'active' => 1
    ];
});
