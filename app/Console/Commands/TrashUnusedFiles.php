<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TrashUnusedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmp:trash';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clear storage/app/tmp directory';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        array_map( 'unlink', array_filter((array) glob(storage_path('app/tmp/*')) ) );
        return 0;
    }
}
