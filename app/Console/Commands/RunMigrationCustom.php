<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunMigrationCustom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Migration By Versions, Modules';

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
        $this->info('***Run Migration By***');
        $this->info('1 - Module');
        $this->info('2 - Version');        
        $choice = $this->ask('Your Choice');
        if($choice == "1"){
            $version = $this->ask('Please Enter Version of Module');
            $path = 'app'.'/'.'Modules'.'/'.$version;
            if(!is_dir($path)){
                $this->error('Version Not Exists!');
                return 0;
            }else{
                $module = $this->ask('Please Enter Name of Module');
                $modules = config("module.modules".".".$version);
                $path = $path.'/'.$module;
                if(in_array($module,$modules) && is_dir($path)){
                    $path = $path.'/'.'Migrations'; 
                    \Artisan::call('migrate --path='.$path);
                    $this->info('Migration From '.$version.' of Module '.$module."is running....");
                }else{
                    $this->error('Please Provide Correct Module w.r.t Version!');
                    return 0;
                }

            }
        }elseif ($choice == "2") {
            $version = $this->ask('Please Enter Version');
            $path = 'app'.'/'.'Modules'.'/'.$version;
            if(!is_dir($path)){
                $this->error('Version Not Exists!');
                return 0;
            }else{
                $modules = config("module.modules".".".$version);
                foreach($modules  as $module) {
                    // Run the Migrations for each of the modules
                    if(is_dir('app'.'/Modules/'.$version.'/'.$module.'/Migrations')) {
                        $path = 'app'.'/Modules/'.$version.'/'.$module.'/Migrations';
                        \Artisan::call('migrate --path='.$path);
                        $this->info("Running Command From ".$version." of Module ".$module."...");
                    }
                }
       
            }
        }else{
            $this->error("Please Make Correct Choice");
        }
        return 0;
    }
}
