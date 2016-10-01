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

    $user = App\User::join('entities','entities.id','users.entity_id')
        ->where('type','client')
        ->with('client')->orderByRaw("RAND()")->first();

    return [
        'provider_id' => function () {
            return App\Provider::orderByRaw("RAND()")->first()->id;
        },
        'client_id' => function ($user) {
            return $user->client->id;
        },
        'sender_id' => function ($user) {
            return $user->id;
        },
        'number' => $faker->numerify($string = '##########'),
        'description' => $faker->randomElement($array = array ('Accounting', 'Finance', 'Sales', 'Parts', 'Service')),
        'note' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'active' => 1
    ];
});
