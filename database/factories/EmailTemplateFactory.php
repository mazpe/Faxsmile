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

$factory->define(App\EmailTemplate::class, function (Faker\Generator $faker) {
    return [
        'company_id' => function () {
            return App\Company::orderByRaw("RAND()")->first()->id;
        },
        'provider_id' => function () {
            return App\Provider::orderByRaw("RAND()")->first()->id;
        },
        'name' => $faker->randomElement($array = array ('Basic Template','Advance Template','POC Template')),
        'body' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'signature' => $faker->company,
        'note' => $faker->realText($maxNbChars = 50, $indexSize = 2),
    ];
});
