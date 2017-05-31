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
        $this->call(ColorsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(SetsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
