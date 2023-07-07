<?php

namespace App\Console\Resolvers;


class Resolver 
{
    public $versions;
    public $modules;
    public $active_version;

    /**
     * Create the new Resolver Instance.
     *
     * @return void
     */

    public function __construct($active_version=null,$modules=null,$version=null) {
        $this->setVersion($version);
        $this->setActiveVersion($active_version);
        $this->setModule($modules);
    }

    /**
     * Set the Active-Version.
     *
     * @return void
     */

    public function setActiveVersion($version=null)
    {
        if($version == null){
            $this->active_version = config('module.active_version');
        }else{
            $this->active_version = $version;
        }
    }


    /**
     * Get the Active-Version.
     *
     * @return string
     */

    public function getActiveVersion()
    {
        return $this->active_version;
    }


    /**
     * Set the Version Arrays.
     *
     * @return void
     */

    public function setVersion($versions=null)
    {
        if($versions == null){
            $this->versions = config('module.versions');
        }else{
            $this->versions = $versions;
        }
    }


    /**
     * Get the console Versions.
     *
     * @return array
     */

    public function getVersion()
    {
        return $this->versions;
    }


    /**
     * Set the Module.
     *
     * @return void
     */

    public function setModule($modules=null)
    {
        if($modules == null){
            $this->modules = config("module.modules.".$this->active_version);
        }else{
            $this->modules = $modules;
        }
    }


    /**
     * Get the Module.
     *
     * @return array
     */

    public function getModule()
    {
        return $this->modules;
    }


    /**
     * Check Module in Configuration.
     *
     * @return bool
     */

    public function checkModuleInConfig($module)
    {
        if(in_array($module,$this->modules)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Check the Version in Config.
     *
     * @return bool
     */
    
    public function checkVersionInConfig($version=null)
    {
        if($version==null){
            $version = $this->active_version;
        }
        if(in_array($version,$this->versions)){
            return true;  
        }else{
            return false;
        }
    }


    /**
     * Check the Directory Exists.
     *
     * @return bool
     */

    public function checkDirectoryExists($path)
    {
        if(is_dir($path)){
            return true;
        }else{
            return false;
        }
    }

}
