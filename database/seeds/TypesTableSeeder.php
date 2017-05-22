<?php

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'name' => 'Artéfacte',
        ]);
        Type::create([
            'name' => 'Ephémère',
        ]);
        Type::create([
            'name' => 'Rituel',
        ]);
        Type::create([
            'name' => 'Enchentement',
        ]);
        Type::create([
            'name' => 'Planeswalker',
        ]);
        Type::create([
            'name' => 'Creature',
        ]);
    }
}
