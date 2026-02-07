<?php

namespace App\Console\Commands;

use App\Services\FootballSeasonService;
use Illuminate\Console\Command;

class CreateFootballSeason extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-football-season';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create annual football season';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        FootballSeasonService::createNewSeason();
        $this->info('New football season has been created.');
    }
}
