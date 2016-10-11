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
        // Providers
        $this->call(ProvidersTableSeeder::class);

        $this->call(RolesTableSeeder::class);

        // Companies
        $this->call(IISCompanySeeder::class);
        $this->call(CompaniesTableSeeder::class);

        // Clients / Users
        $this->call(ClientsTableSeeder::class);

//        // Faxes
        $this->call(FaxesTableSeeder::class);

        // Admins/User
        $this->call(SuperAdminUserSeeder::class);
        $this->call(ProviderAdminUserSeeder::class);
        $this->call(CompanyAdminUserSeeder::class);
        $this->call(ClientAdminUserSeeder::class);
        $this->call(UserSeeder::class);

        // Configs
        $this->call(EmailConfigsTableSeeder::class);
        $this->call(EmailTemplatesTableSeeder::class);

//        $this->call(UsersTableSeeder::class);
    }
}
