<?php

namespace App\Console\Commands;

use App\Models\Card;
use Illuminate\Console\Command;
use Goutte\Client;

class ScrappingMtg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraping:mtg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'http://magic.wizards.com/fr/products/amonkhet/cards');
        $bar = $this->output->createProgressBar($crawler->filter('.resizing-cig')->count());
        $this->info('Downloading all card in your database');
        $crawler->filter('.resizing-cig')->each(function ($node, $i) use ($bar){
            Card::add($node->text(), $node->children()->children()->image()->getUri());
            $bar->advance();
        });
        $bar->finish();
        $this->info('Downloading is finished.');
    }
}
