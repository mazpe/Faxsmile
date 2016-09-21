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

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    $type = ['White Label', 'Reseller'];

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
        'fax_domain' => $faker->domainName,
        'domain' => $faker->domainName,
        'time_zone' => $faker->timezone,
        'external_account' => $faker->randomNumber($nbDigits = 5),
        'contact' => $faker->name,
        'contact_phone' => $faker->phoneNumber,
        'note' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'active' => 1
    ];
});
