<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'User')->first();

        $entity_id = App\Client::orderBy('id','ASC')->first()->id;

        $user = User::create([
            'entity_id' => $entity_id,
            'first_name' => 'User',
            'last_name' => '',
            'email' => 'user@faxit.cloud',
            'password' => 'User',
            'remember_token' => str_random(10),
        ]);
        $user->roles()->attach($role->id);

    }
}
