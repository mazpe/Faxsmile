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

$factory->define(App\Setting::class, function (Faker\Generator $faker) {
    $departmentNames = ['Accounting','Sales', 'Finance'];
    $departmentName = $departmentNames[array_rand($departmentNames)];
    $incoming_fax = "Fax ID: {{ \$fax_id }}<br>"
                 .= "Fax Job: {{ \$fax_job }}<br>"
                 .= "You receievd a fax message from {{ \$fax_from }} at {{ \$timestamp }} <br><br>"
                 .= "Your Fax Number Is: {{ \$fax_to  }}";

    return [
        'entity_id' => function () {
            return App\Company::orderByRaw("RAND()")->first()->id;
        },
        'from_email' => $departmentName.'@'.$faker->safeEmailDomain,
        'from_name' => $departmentName,
        'signature' => $faker->company,
        'incoming_fax' => $incoming_fax,
        'note' => $faker->realText($maxNbChars = 50, $indexSize = 2),
    ];
});
