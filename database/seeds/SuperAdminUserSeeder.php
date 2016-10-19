<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Company;

class SuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'Super Admin')->first();

        $iisUser = Company::where('name', 'Innovative Internet Solutions')->first();

        $user = User::create([
            'entity_id' => $iisUser->id,
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@faxit.cloud',
            'password' => 'SuperAdmin',
            'remember_token' => str_random(10),
        ]);

        $user->roles()->attach($role->id);

    }
}
