<?php

namespace App\Console\Commands;

use App\Models\Card;
use App\Models\Set;
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
    protected $description = 'This command scrap the magic the gathering website';

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
        $set_name = $this->choice('Choice your set?', $this->getCollectionOfSets());
        $set = Set::where('name', $set_name)->first();
        $client = new Client();
        $crawler = $client->request('GET', $set->url_cards);
        $bar = $this->output->createProgressBar($crawler->filter('.resizing-cig')->count());
        $this->info('Downloading all cards of '.$set->name);
        $crawler->filter('.resizing-cig')->each(function ($node) use ($bar, $set){
            Card::add($node->text(), $node->children()->children()->image()->getUri(), $set->id);
            $bar->advance();
        });
        $bar->finish();
        $this->info('Downloading is finished.');
    }

    private function getCollectionOfSets()
    {
        $sets = Set::all();
        $collection_sets = collect();
        foreach($sets as $set) {
            $collection_sets->push($set->name);
        }
        return $collection_sets->toArray();
    }
}
