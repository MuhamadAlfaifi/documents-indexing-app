<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MeiliSearch\Client;

class SetupMeili extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meili:filterables {model} {filterables*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update meilisearch settings to set filterable attributes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = app(Client::class);
        $model = new ($this->argument('model'));

        $client->index($model->searchableAs())->updateSettings([
            'filterableAttributes' => $this->argument('filterables'),
        ]);

        $this->info('The command was successful!');
        $this->line('Info: Meilisearch server needs some few minutes to reflect. PLEASE WAIT!');
        
        return 0;
    }
}
