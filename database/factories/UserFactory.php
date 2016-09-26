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
    static $password;

    return [
        'client_id' => 1,
        'fax_id' => 1,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = 'secret',
        'remember_token' => str_random(10),
        'note' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'active' => 1
    ];
});

