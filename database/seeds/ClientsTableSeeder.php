<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Create client and users for client
     *
     * @return void
     */
    public function run()
    {
        factory(App\Client::class, 10)->create()->each(function($u) {
            $u->users()->saveMany(factory(App\User::class, 5)->make());
        });
    }
}
