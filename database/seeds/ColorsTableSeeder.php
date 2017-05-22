<?php

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create([
            'name' => 'Red',
        ]);
        Color::create([
            'name' => 'White',
        ]);
        Color::create([
            'name' => 'Blue',
        ]);
        Color::create([
            'name' => 'Black',
        ]);
        Color::create([
            'name' => 'Green',
        ]);
    }
}
