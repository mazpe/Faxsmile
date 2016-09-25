<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '-1');
        factory(App\User::class, 5)->create()->each(function($u) {
            factory(App\User::class)->make();
        });
    }
}
