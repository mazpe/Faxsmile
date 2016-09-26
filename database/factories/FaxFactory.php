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
    $description = ['Accounting', 'Finance', 'Sales', 'Parts', 'Service'];

    return [
        'client_id' => function () {
            return App\Client::orderByRaw("RAND()")->first()->id;
        },
        'provider_id' => function () {
            return App\Provider::orderByRaw("RAND()")->first()->id;
        },
        'number' => $faker->numerify($string = '##########'),
        'description' => $description[array_rand($description)],
        'note' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'active' => 1
    ];
});
