<?php

use Illuminate\Database\Seeder;
use App\User;

class ClientAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entity_id = App\Client::orderBy('id','ASC')->first()->id;

        User::create([
            'entity_id' => $entity_id,
            'first_name' => 'Client',
            'last_name' => 'Admin',
            'email' => 'client@faxit.cloud',
            'password' => 'ClientAdmin',
            'remember_token' => str_random(10),
        ]);
    }
}
