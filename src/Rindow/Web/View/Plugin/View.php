<?php
namespace Rindow\Web\View\Plugin;

use Rindow\Web\View\View as ViewView;

class View
{
    protected $viewManager;
    protected $pluginManager;
    
    public function __construct($viewManager=null,$pluginManager=null)
    {
        if($viewManager)
            $this->setViewManager($viewManager);
        if($pluginManager)
            $this->setPluginManager($pluginManager);
    }

    public function setViewManager($viewManager)
    {
        $this->viewManager = $viewManager;
    }

    public function setPluginManager($pluginManager)
    {
        $this->pluginManager = $pluginManager;
    }

    public function __invoke($templateName,array $templateVariables=null)
    {
        $fullpath = $this->viewManager->resolveTemplate($templateName);
        $view = new ViewView($this->pluginManager);
        return $view->renderTemplate($fullpath,$templateVariables);
    }
}
