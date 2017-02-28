<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Create client and users for client
     *
     * @return void
     */
    public function run()
    {
        factory(App\Client::class, 10)->create()->each(function($u) {
            $u->users()->saveMany(
                $users = factory(App\User::class, 5)->make()
            );

            $role = App\Role::where('name', 'User')->first();

            $users->each(function ($item, $key) use($role) {
                $user = App\User::find($item->id);
                $user->roles()->attach($role->id);
            });

        });
    }
}
