<?php
namespace Rindow\Web\View;

use Rindow\Web\View\Exception;

class PluginManager
{
    protected $serviceLocator;
    protected $config;

    public function __construct(array $config=null,$serviceLocator=null)
    {
        if($config)
            $this->setConfig($config);
        if($serviceLocator)
            $this->setServiceLocator($serviceLocator);
    }

    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function setConfig(array $config=null)
    {
        $this->config = $config;
    }

    public function set($name,$plugin)
    {
        $this->config[$name] = $plugin;
    }

    public function get($name,array $options=null)
    {
        if(!isset($this->config[$name]))
            throw new Exception\DomainException('plugin is not found.: "'.$name.'"');
        $plugin = $this->config[$name];
        if(is_string($plugin)) {
            if($this->serviceLocator==null)
                throw new Exception\DomainException('the service locator is not specified.');
            $plugin = $this->serviceLocator->get($plugin,$options);
            if(method_exists($plugin, 'setPluginManager'))
                $plugin->setPluginManager($this);
            $this->config[$name] = $plugin;
        }
        return $plugin;
    }
}