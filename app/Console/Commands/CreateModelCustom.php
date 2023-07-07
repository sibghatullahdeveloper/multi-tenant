<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Str;


class CreateModelCustom extends GeneratorCommand
{
   
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'create:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new a class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return app_path('Console/Stubs/model.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $versions = config('module.versions');
        if($this->option('versions') == null){
            $version = config('module.active_version');
            if($version == null){
                $this->error('Please Register Active Version in Config/Module');
                die();
            }
        }else{
            if(in_array($this->option('versions'),$versions)){
                $version = $this->option('versions');  
            }else{
                $this->error('Please Register Version in Config/Module');
                die();
            }
        }
        $path = config('module.modules_path');
        $path = $path.'/'.$version;
        if(!is_dir($path)){
            $this->error('Version Not Exists!');
            die();
        }

        $modules = config("module.modules".".".$version);
        $path = $path.'/'.$this->argument('module');
        if(in_array($this->argument('module'),$modules) && is_dir($path)){
            return $rootNamespace.'/Modules/'.$version.'/'.$this->argument("module").'/Models';
        }else{
            $this->error('Please Provide Correct Module w.r.t Version!');
            die();  
        }
        
    }

    
    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {    

        $versions = config('module.versions');
        if($this->option('versions') == null){
            $version = config('module.active_version');
            if($version == null){
                $this->error('Please Register Active Version in Config/Module');
                return 0;
            }
        }else{
            if(in_array($this->option('versions'),$versions)){
                $version = $this->option('versions');  
            }else{
                $this->error('Please Register Version in Config/Module');
                return 0;
            }
        }

        $path = config('module.modules_path');
        $path = $path.'/'.$version;
        
        if(!is_dir($path)){
            $this->error('Version Not Exists!');
            die();
        }

        $modules = config("module.modules".".".$version);
        $path = $path.'/'.$this->argument('module');
        if(in_array($this->argument('module'),$modules) && is_dir($path)){
            $namespace = ("App\Modules\\".$version.'\\'.$this->argument("module").'\Models');
            $stub = (str_replace('DummyNamespace', $namespace , $stub));
            return $this;
        }else{
            $this->error('Please Provide Correct Module w.r.t Version!');
            die();  
        }   
    }


    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return ($this->laravel['path'].'/'.str_replace('\\', '/', $name).'.php');
    }



    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::REQUIRED, 'The name of the module.'],
            ['name', InputArgument::REQUIRED, 'The name of the model.'],
        ];
    }



    /**
     * Get the console command arguments.
     *
     * @return array
     * 
     */

    protected function getOptions()
    {
        return [
            ['versions', null, InputOption::VALUE_OPTIONAL, 'The version of the module.'],
        ];
    }
}

