<?php

namespace App\Console\Commands;

use App\Console\Resolvers\Resolver;
use Illuminate\Console\Command;

class CreateMigrationCustom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:migration {module} {Tablename} {version?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Migration of Specific Module';

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
        $resolver = new Resolver();
        $resolver->setActiveVersion($this->argument('version'));
        $checkVersionInConfig = $resolver->checkVersionInConfig($this->argument('version'));
        if($checkVersionInConfig == false){
            $this->error('Please Register Version in Config/Module');
            return 0;
        }
        $path = config('module.modules_path');
        $path = $path.'/'.$resolver->getActiveVersion();

        if($resolver->checkDirectoryExists($path) == false){
            $this->error('Version Folder Not Exists!');
            return 0;
        }
        $path = $path.'/'.$this->argument('module');
        
        if($resolver->checkModuleInConfig($this->argument('module')) && $resolver->checkDirectoryExists($path)){
            $path = $path.'/'.'Migrations'; 
            \Artisan::call('make:migration '.$this->argument("Tablename").' --path='.$path);
            \Artisan::call('vendor:publish --tag=migrations');
            $this->info('Migration Created in '.$path.' and Published');
        }else{
            $this->error('Please Provide Correct Module w.r.t Version!');
            return 0;
        }
    }
}
