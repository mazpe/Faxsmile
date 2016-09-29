<?php

use Illuminate\Database\Seeder;
use App\User;

class ProviderAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entity_id = App\Provider::orderBy('id','ASC')->first()->id;

        User::create([
            'entity_id' => $entity_id,
            'first_name' => 'Provider',
            'last_name' => 'Admin',
            'email' => 'provider@faxit.cloud',
            'password' => 'ProviderAdmin',
            'remember_token' => str_random(10),
        ]);
    }
}
