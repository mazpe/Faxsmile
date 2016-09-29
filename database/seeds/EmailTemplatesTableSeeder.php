<?php

use Illuminate\Database\Seeder;

class EmailTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\EmailTemplate::class, 10)->create()->each(function($u) {
            factory(App\EmailTemplate::class)->make();
        });
    }
}
