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
            'client_id' => '1',
            'name' => 'Administrator',
            'email' => 'superadmin@faxit.cloud',
            'password' => 'SuperAdmin',
        ]);
    }
}
