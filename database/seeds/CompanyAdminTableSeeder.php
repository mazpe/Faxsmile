<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Company;

class CompanyAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'Company Admin')->first();
        $entity_id = Company::orderBy('id','ASC')->first()->id;

        $user = User::create([
            'entity_id' => $entity_id,
            'first_name' => 'Company',
            'last_name' => 'Admin',
            'email' => 'company@faxit.cloud',
            'password' => 'CompanyAdmin',
            'remember_token' => str_random(10),
        ]);
        $user->roles()->attach($role->id);
    }
}
