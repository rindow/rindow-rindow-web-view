<?php
namespace Rindow\Web\View;

class Module
{
    public function getConfig()
    {
        return array(
            'container' => array(
                'aliases' => array(
                    'Rindow\Web\Mvc\DefaultViewManager'   => 'Rindow\Web\View\DefaultViewManager',
                ),
                'components' => array(
                    'Rindow\Web\View\DefaultViewManager' => array(
                        'class'=>'Rindow\Web\View\ViewManager',
                        'properties' => array(
                            'pluginManager' => array('ref'=>'Rindow\Web\View\DefaultPluginManager'),
                        ),
                    ),
                    'Rindow\Web\View\DefaultPluginManager' => array(
                        'class'=>'Rindow\Web\View\PluginManager',
                        'properties' => array(
                            'config' => array('config'=>'web::view::plugins'),
                            'serviceLocator' => array('ref'=>'ServiceLocator'),
                        ),
                    ),
                    'Rindow\Web\View\Plugin\Escape' => array(
                    ),
                    'Rindow\Web\View\Plugin\Placeholder' => array(
                    ),
                    'Rindow\Web\View\Plugin\View' => array(
                        'properties' => array(
                            'viewManager' => array('ref'=>'Rindow\Web\View\DefaultViewManager'),
                        ),
                    ),
                    'Rindow\Web\View\Plugin\Cache' => array(
                        'properties' => array(
                            'cache' => array('ref'=>'SimpleCache'),
                        ),
                    ),
                ),
            ),
            'web' => array(
                'view' => array(
                    'plugins' => array(
                        'placeholder' => 'Rindow\Web\View\Plugin\Placeholder',
                        'escape' => 'Rindow\Web\View\Plugin\Escape',
                        'view'  => 'Rindow\Web\View\Plugin\View',
                        'cache' => 'Rindow\Web\View\Plugin\Cache',
                        'url'   => 'Rindow\Web\Mvc\DefaultUrlGenerator',
                        'form'  => 'Rindow\Web\Form\View\DefaultFormRenderer',
                    ),
                ),
            ),
        );
    }
}