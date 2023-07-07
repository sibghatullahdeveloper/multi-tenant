<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearRoutesViewsCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        \Artisan::call('route:cache');
        $this->info('Route Cache Cleared');
        \Artisan::call('view:cache');
        $this->info('Views Cache Cleared');
        
    }
}
