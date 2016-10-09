<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class ProviderAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'Provider Admin')->first();
        $entity_id = App\Provider::orderBy('id','ASC')->first()->id;

        $user = User::create([
            'entity_id' => $entity_id,
            'first_name' => 'Provider',
            'last_name' => 'Admin',
            'email' => 'provider@faxit.cloud',
            'password' => 'ProviderAdmin',
            'remember_token' => str_random(10),
        ]);
        $user->roles()->attach($role->id);
    }
}
