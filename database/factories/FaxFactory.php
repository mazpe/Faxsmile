<?php

use App\Fax;
use App\User;
use App\Provider;


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

$factory->define(Fax::class, function (Faker\Generator $faker) {

//    $user = App\User::getUser();

    return [
        'provider_id' => function () {
            return App\Provider::inRandomOrder()->first()->id;
        },
        'client_id' => function ()  {
//            return $user->client->id;
            return App\Client::inRandomOrder()->first()->id;
        },
//        'sender_id' => function () use ($user) {
//            return $user->id;
//        },
        'number' => $faker->numerify($string = '##########'),
        'description' => $faker->randomElement($array = array ('Accounting', 'Finance', 'Sales', 'Parts', 'Service')),
        'note' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'active' => 1
    ];

});
