<?php

use App\User;
use Illuminate\Database\Seeder;
Use App\Library\Helpers\Seeders;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = Seeders::usersSeeds();

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
