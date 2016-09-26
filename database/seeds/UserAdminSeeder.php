<?php

use Illuminate\Database\Seeder;
use App\User;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'client_id' => 1,
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@faxit.cloud',
            'password' => 'SuperAdmin',
            'remember_token' => str_random(10),
        ]);
    }
}
