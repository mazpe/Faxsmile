<?php

use Illuminate\Database\Seeder;
use App\User;

class CompanyAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entity_id = App\Company::orderBy('id','ASC')->first()->id;

        User::create([
            'entity_id' => $entity_id,
            'first_name' => 'Company',
            'last_name' => 'Admin',
            'email' => 'company@faxit.cloud',
            'password' => 'CompanyAdmin',
            'remember_token' => str_random(10),
        ]);
    }
}
