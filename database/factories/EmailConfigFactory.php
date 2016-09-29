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

$factory->define(App\EmailConfig::class, function (Faker\Generator $faker) {
    $departmentNames = ['White Label', 'Reseller'];
    $departmentName = $departmentNames[array_rand($departmentNames)];

    return [
        'company_id' => function () {
            return App\Company::orderByRaw("RAND()")->first()->id;
        },
        'provider_id' => function () {
            return App\Provider::orderByRaw("RAND()")->first()->id;
        },
        'from_email' => $departmentName.'@'.$faker->safeEmailDomain,
        'from_name' => $departmentName,
        'body' => '',
        'signature' => $faker->company,
    ];
});
