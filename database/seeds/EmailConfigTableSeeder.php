<?php

use Illuminate\Database\Seeder;

class EmailConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\EmailConfig::class, 5)->create()->each(function($u) {
            factory(App\EmailConfig::class)->make();
        });
    }
}
