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
            'name' => 'Rouge',
        ]);
        Color::create([
            'name' => 'Blanc',
        ]);
        Color::create([
            'name' => 'Bleu',
        ]);
        Color::create([
            'name' => 'Noir',
        ]);
        Color::create([
            'name' => 'Vert',
        ]);
    }
}
