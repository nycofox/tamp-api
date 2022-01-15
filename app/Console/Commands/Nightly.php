<?php

namespace App\Console\Commands;

use App\Actions\Scrapers\UpdateGenreTmdb;
use App\Actions\Scrapers\UpdateMovieTmdb;
use App\Actions\Scrapers\UpdatePersonTmdb;
use Illuminate\Console\Command;

class Nightly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tamp:nightly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Nightly tasks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        UpdateGenreTmdb::updateGenres();
        UpdatePersonTmdb::updatePopular();
        UpdateMovieTmdb::updatePopular();
    }
}
