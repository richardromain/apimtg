<?php

use Illuminate\Database\Seeder;
use App\Models\Set;

class SetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Set::create([
            'name' => 'Amonkhet',
            'url_cards' => 'http://magic.wizards.com/fr/products/amonkhet/cards'
        ]);

        Set::create([
            'name' => 'Révolte éthérique',
            'url_cards' => 'http://magic.wizards.com/fr/products/aether-revolt-cards'
        ]);

        Set::create([
            'name' => 'Kaladesh',
            'url_cards' => 'http://magic.wizards.com/fr/content/kaladesh-cards'
        ]);
    }
}
