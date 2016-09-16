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

$factory->define(App\Fax::class, function (Faker\Generator $faker) {
    return [
        'client_id' => 1,
        //'number' => $faker->randomNumber($nbDigits = 10),
        'number' => $faker->numerify($string = '##########'),
        'notes' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'active' => 1
    ];
});
