<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateModuleDirectories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:module {module} {version?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Module Directories';

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
        $versions = config('module.versions');
        if($this->argument('version') == null){
            $version = config('module.active_version');
            if($version == null){
                $this->error('Please Register Active Version in Config/Module');
                return 0;
            }
        }else{
            if(in_array($this->argument('version'),$versions)){
                $version = $this->argument('version');  
            }else{
                $this->error('Please Register Version in Config/Module');
                return 0;
            }
        }
        
        $path = config('module.modules_path');
        $path = $path.'/'.$version;
        if(!is_dir($path)){
            $this->error('Version Not Exists!');
            return 0;
        }
        $modules = config("module.modules".".".$version);
        $path = $path.'/'.ucfirst($this->argument('module'));
        if(in_array($this->argument('module'),$modules)){
            if(is_dir($path)){
                $this->error('Module in Version Already Exists');
                return 0;    
            }else{
                mkdir($path, 0755);
                $this->info($this->argument('module').' folder is created');
                $folders = [
                    'Commands',
                    'Controllers',
                    'Jobs',
                    'Migrations',
                    'Models',
                    'Observers',
                    'Services',
                    'Tests',
                    'Views'
                ];

                foreach ($folders as $folder) {
                    mkdir($path.'/'.$folder, 0755, true);
                    $this->info($folder.' is created inside of '.$this->argument('module'));
                }
                $path = app_path().'/'.'Modules'.'/'.$version;
                $path = $path.'/'.$this->argument('module');
                fopen($path.'/'."config.php", 'w') or die("Failed to create file"); 
                $this->info(' Config file created inside of '.$this->argument('module'));
                fopen($path.'/'."routes.php", 'w') or die("Failed to create file"); 
                $this->info(' Routes file created inside of '.$this->argument('module'));
                fopen($path.'/'.ucfirst($this->argument('module'))."ModuleExports.php", 'w') or die("Failed to create file"); 
                $this->info(' External file created inside of '.$this->argument('module'));

            }
        }else{
            $this->error('Please Register Module in Config/Module.php!');
            return 0;
        }

        
        return 0;
    }
}
