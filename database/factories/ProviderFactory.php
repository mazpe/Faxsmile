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

$factory->define(App\Provider::class, function (Faker\Generator $faker) {
    $type = ['Fax Services'];
    return [
        'type' => $type[array_rand($type)],
        'name' => $faker->company,
        'address_1' => $faker->streetAddress,
        'address_2' => '',
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zip' => $faker->postcode,
        'phone' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
        'website' => $faker->domainName,
        'external_account' => $faker->randomNumber($nbDigits = 5),
        'contact' => $faker->name,
        'contact_phone' => $faker->phoneNumber,
        'notes' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'active' => 1
    ];
});
