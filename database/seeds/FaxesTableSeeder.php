<?php

use Illuminate\Database\Seeder;

class FaxesTableSeeder extends Seeder
{
    /**
     * Fax seeder creates faxes that not been previously assigned to a User
     * Check App\Fax factory for details
     *
     * @return void
     */
    public function run()
    {
//        factory(App\Fax::class,10)->create();

        // needs improving... breaks after 10
        for ($i = 1; $i <= 10; $i++) {
            factory(App\Fax::class)->create();
        }
    }
}
