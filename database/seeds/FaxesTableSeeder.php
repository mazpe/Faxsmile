<?php

use Illuminate\Database\Seeder;

class FaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Fax::class, 5)->create()->each(function($u) {
            factory(App\Fax::class)->make();
        });
    }
}
