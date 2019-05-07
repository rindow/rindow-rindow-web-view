<?php
namespace Rindow\Web\View;

class ViewManager /* implements ViewManagerInterface */
{
    protected $config;
    protected $pluginManager;
    protected $stream;
    protected $currentTemplatePaths;

    public function __construct($config=null,$pluginManager=null)
    {
        if($config)
            $this->setConfig($config);
        if($pluginManager)
            $this->setPluginManager($pluginManager);
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function setPluginManager($pluginManager)
    {
        $this->pluginManager = $pluginManager;
    }

    public function getPluginManager()
    {
        return $this->pluginManager;
    }

    public function setCurrentTemplatePaths($currentTemplatePaths)
    {
        $this->currentTemplatePaths = $currentTemplatePaths;
    }

    public function setStream($stream)
    {
        $this->stream = $stream;
    }

    public function getStream()
    {
        return $this->stream;
    }

    public function render($templateName,array $variables=null,$templatePaths=null)
    {
        if(!is_string($templateName))
            throw new Exception\InvalidArgumentException('templateName must be string.');
            
        $fullpath = $this->resolveTemplate($templateName,$templatePaths);
        $view = new View($this->getPluginManager(),$this->stream);
        $output = $view->renderTemplate($fullpath,$variables);
        if($view->layout) {
            if($view->layout=='disable')
                $layout = null;
            else
                $layout = $view->layout;            
        } elseif(isset($this->config['layout'])) {
            $layout = $this->config['layout'];
        } else {
            $layout = null;
        }
        $lastLayout = null;
        while($layout && $layout!='disable') {
            $fullpath = $this->resolveTemplate($layout,$templatePaths);
            $view->content = $output;
            if(is_resource($output))
                $content = $output;
            else
                $content = null;
            $output = $view->renderTemplate($fullpath,$variables);
            if($content)
                fclose($content);
            if($layout==$view->layout)
                break;
            $layout=$view->layout;
        }
        return $output;
    }

    public function resolveTemplate($templateName,$templatePaths=null)
    {
        if($templatePaths==null)
            $templatePaths = $this->currentTemplatePaths;

        if($templatePaths==null) {
            throw new Exception\DomainException('template path is not specified: "'.$templateName.'"');
        }
        $found = false;
        $filename = $templateName.$this->getPostfix();
        foreach($templatePaths as $path) {
            $fullpath = $path.'/'.$filename;
            if(file_exists($fullpath)) {
                $found = true;
                break;
            }
        }
        if(!$found)
            throw new Exception\DomainException('template not found: "'.$templateName.'" in '.implode(',',$templatePaths));
        return $fullpath;
    }

    protected function getPostfix()
    {
        if(isset($this->config['postfix']))
            return $this->config['postfix'];
        else
            return '.php';
    }
}
