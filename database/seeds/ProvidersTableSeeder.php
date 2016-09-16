<?php

use Illuminate\Database\Seeder;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Provider::class, 5)->create()->each(function($u) {
            factory(App\Provider::class)->make();
        });
    }
}
