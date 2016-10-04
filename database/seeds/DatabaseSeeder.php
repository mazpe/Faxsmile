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

        // Companies
        $this->call(IISCompanyTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);

        // Clients / Users
        $this->call(ClientsTableSeeder::class);

        // Faxes
        $this->call(FaxesTableSeeder::class);

        // Admin Users
        $this->call(SuperAdminTableSeeder::class);
        $this->call(ProviderAdminTableSeeder::class);
        $this->call(CompanyAdminTableSeeder::class);
        $this->call(ClientAdminTableSeeder::class);

        // Configs
        $this->call(EmailConfigsTableSeeder::class);
        $this->call(EmailTemplatesTableSeeder::class);

//        $this->call(UsersTableSeeder::class);
    }
}
