<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(JackCompanyTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);
        $this->call(EmailConfigsTableSeeder::class);
        $this->call(EmailTemplatesTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(FaxesTableSeeder::class);
        $this->call(UserAdminSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
