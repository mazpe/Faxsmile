<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Super Admin',
            'active' => 1,
        ]);
        Role::create([
            'name' => 'Provider Admin',
            'active' => 1,
        ]);
        Role::create([
            'name' => 'Company Admin',
            'active' => 1,
        ]);
        Role::create([
            'name' => 'Client Admin',
            'active' => 1,
        ]);
        Role::create([
            'name' => 'User',
            'active' => 1,
        ]);
    }
}
