<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class ClientAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'Client Admin')->first();
        $entity_id = App\Client::orderBy('id','ASC')->first()->id;

        $user = User::create([
            'entity_id' => $entity_id,
            'first_name' => 'Client',
            'last_name' => 'Admin',
            'email' => 'client@faxit.cloud',
            'password' => 'ClientAdmin',
            'remember_token' => str_random(10),
        ]);

        $user->roles()->attach($role->id);


    }
}
