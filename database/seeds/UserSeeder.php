<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dummyUser = [
            'company_name' => 'company', 
            'email' => 'company@mail.com',
            'password' => bcrypt('password'),
            'address' => 'via di qua, 1',
            'vat_number' => '99999999999',
        ];

        User::create($dummyUser);

        factory(User::class, 10) -> create();
    }
}
