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

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'company_id' => function () {
            return App\Company::orderByRaw("RAND()")->first()->id;
        },
        'name' => $faker->company,
        'address_1' => $faker->streetAddress,
        'address_2' => '',
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zip' => $faker->postcode,
        'phone' => $faker->phoneNumber,
        'fax' => $faker->phoneNumber,
        'website' => $faker->domainName,
        'contact' => $faker->name,
        'contact_phone' => $faker->phoneNumber,
        'notes' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'active' => 1
    ];
});
