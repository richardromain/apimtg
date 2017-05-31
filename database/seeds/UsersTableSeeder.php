<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Romain RICHARD',
            'email' => 'romain.richard.19@gmail.com',
            'password' => bcrypt('1940u71993!')
        ]);
    }
}
