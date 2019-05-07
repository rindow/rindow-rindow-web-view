<?php
namespace RindowTest\Web\View\ViewTest;

use PHPUnit\Framework\TestCase;
use Rindow\Container\Container;
//use Rindow\Web\Mvc\Context;
use Rindow\Web\View\PluginManager;
//use Rindow\Web\Router\Router;
//use Rindow\Web\Http\Message\ServerRequestFactory;
//use Rindow\Web\Http\Message\Response;

// Test Target Classes
use Rindow\Web\View\ViewManager;
use Rindow\Web\View\View;

class Test extends TestCase
{
    static $RINDOW_TEST_RESOURCES;
    public static function setUpBeforeClass()
    {
        self::$RINDOW_TEST_RESOURCES = __DIR__.'/../../../resources';
    }

    public function getContainer($options)
    {
        $config = array(
            'container' => array(
                'components' => array(
                    'ViewManager' => array(
                        'class'=>'Rindow\Web\View\ViewManager',
                        'properties' => array(
                            'config' => array('config'=>'web::view'),
                            'pluginManager' => array('ref'=>'PluginManager'),
                        ),
                    ),
                    'PluginManager' => array(
                        'class'=>'Rindow\Web\View\PluginManager',
                        'properties' => array(
                            'config' => array('config'=>'web::view::plugins'),
                            'serviceLocator' => array('ref'=>'ServiceLocator'),
                        ),
                    ),
                    'Rindow\Web\View\Plugin\Escape' => array(
                    ),
                ),
            ),
        );
        $config = array_replace_recursive($config, $options);
        $sm = new Container();
        $sm->setConfig($config['container']);
        $sm->setInstance('ServiceLocator',$sm);
        $sm->setInstance('config',$config);
        return $sm;
    }
    public function testResolveTemplate()
    {
        $templateName = 'index/index';
        $templatePaths = array(
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local',
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global',
        );
        $viewManager = new ViewManager();
        $result = $viewManager->resolveTemplate($templateName,$templatePaths);
        $this->assertEquals(self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local/index/index.php',$result);
        $templateName = 'layout/layout';
        $result = $viewManager->resolveTemplate($templateName,$templatePaths);
        $this->assertEquals(self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global/layout/layout.php',$result);
    }
    /**
     * @expectedException        Rindow\Web\View\Exception\DomainException
     * @expectedExceptionMessage template not found: "index/none"
     */
    public function testResolveTemplateNotFound()
    {
        $templateName = 'index/none';
        $templatePaths = array(
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local',
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global',
        );
        $viewManager = new ViewManager();
        $result = $viewManager->resolveTemplate($templateName,$templatePaths);
    }

    public function testRenderTemplate()
    {
        $templateFullPath = self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local/index/index.php';
        $templateVariables = array('test'=>'abc');
        $view = new View(new PluginManager(array(),new Container()));
        $result = $view->renderTemplate($templateFullPath,$templateVariables);
        $this->assertEquals('abc',$result);
    }

    public function testRenderContent()
    {
        $templateName = 'index/index';
        $templatePaths = array(
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local',
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global',
        );
        $variables = array(
            'test' => 'abc',
        );
        $viewManager = new ViewManager(array(),new PluginManager(array(),new Container()));
        $answer = <<<EOD
abc
EOD;
        $result = $viewManager->render($templateName,$variables,$templatePaths);
        $answer = str_replace(array("\r","\n"), array("",""), $answer);
        $result = str_replace(array("\r","\n"), array("",""), $result);
        $this->assertEquals($answer,$result);
    }

    public function testRenderLayout()
    {
        $variables = array('test'=>'abc');
        $templateName = 'index/index';
        $templatePaths = array(
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local',
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global',
        );
        $config = array(
            'layout' => 'layout/layout',
        );
        $variables = array(
            'test' => 'abc',
        );
        $viewManager = new ViewManager($config,new PluginManager(array(),new Container()));
        $answer = <<<EOD
<html>
<head>
<title>Test</title>
</head>
<body>
abc
</body>
</html>
EOD;
        $result = $viewManager->render($templateName,$variables,$templatePaths);
        $answer = str_replace(array("\r","\n"), array("",""), $answer);
        $result = str_replace(array("\r","\n"), array("",""), $result);
        $this->assertEquals($answer,$result);
    }

    public function testChangeLayout()
    {
        $templateName = 'index/changelayout';
        $templatePaths = array(
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local',
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global',
        );
        $config = array(
            'layout' => 'layout/layout',
        );
        $variables = array(
            'test' => 'abc',
        );
        $viewManager = new ViewManager($config,new PluginManager(array(),new Container()));
        $answer = <<<EOD
Other Layout
abc
EOD;
        $result = $viewManager->render($templateName,$variables,$templatePaths);
        $answer = str_replace(array("\r","\n"), array("",""), $answer);
        $result = str_replace(array("\r","\n"), array("",""), $result);
        $this->assertEquals($answer,$result);
    }

    public function testChangePostfix()
    {
        $templateName = 'index/postfix';
        $templatePaths = array(
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local',
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global',
        );
        $config = array(
            'layout' => 'layout/postfix',
            'postfix' => '.phtml',
        );
        $variables = array(
            'test' => 'abc',
        );
        $viewManager = new ViewManager($config,new PluginManager(array(),new Container()));
        $answer = <<<EOD
phtml Layout
test change postfix
abc
EOD;
        $result = $viewManager->render($templateName,$variables,$templatePaths);
        $answer = str_replace(array("\r","\n"), array("",""), $answer);
        $result = str_replace(array("\r","\n"), array("",""), $result);
        $this->assertEquals($answer,$result);
    }

    public function testPlugin()
    {
        $templateName = 'index/escape';
        $templatePaths = array(
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local',
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global',
        );
        $config = array(
            'web' => array(
                'view' => array(
                    'plugins' => array(
                        'escape' => 'Rindow\Web\View\Plugin\Escape',
                    ),
                ),
            ),
        );
        $variables = array(
            'test' => '<abc>',
        );
        $sm = $this->getContainer($config);
        $viewManager = $sm->get('ViewManager');
        $answer = <<<EOD
&lt;abc&gt;
EOD;
        $result = $viewManager->render($templateName,$variables,$templatePaths);
        $answer = str_replace(array("\r","\n"), array("",""), $answer);
        $result = str_replace(array("\r","\n"), array("",""), $result);
        $this->assertEquals($answer,$result);
    }

    /**
     * @expectedException        Rindow\Web\View\Exception\DomainException
     * @expectedExceptionMessage plugin is not found.: "escape"
     */
    public function testNoPlugin()
    {
        $templateName = 'index/escape';
        $templatePaths = array(
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local',
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global',
        );
        $config = array(
            'web' => array(
                'view' => array(
                    'plugins' => array(
                    ),
                ),
            ),
        );
        $variables = array(
            'test' => '<abc>',
        );
        $sm = $this->getContainer($config);
        $viewManager = $sm->get('ViewManager');
        $result = $viewManager->render($templateName,$variables,$templatePaths);
    }

    public function testNoVariable()
    {
        $templateName = 'index/novariable';
        $templatePaths = array(
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local',
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global',
        );
        $config = array();
        $viewManager = new ViewManager($config,new PluginManager(array(),new Container()));
        $answer = <<<EOD
Hello
EOD;
        $result = $viewManager->render($templateName,null,$templatePaths);
        $answer = str_replace(array("\r","\n"), array("",""), $answer);
        $result = str_replace(array("\r","\n"), array("",""), $result);
        $this->assertEquals($answer,$result);
    }

    public function testCurrentTemplatePaths()
    {
        $templateName = 'index/novariable';
        $templatePaths = array(
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local',
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global',
        );
        $config = array();
        $viewManager = new ViewManager($config,new PluginManager(array(),new Container()));
        $viewManager->setCurrentTemplatePaths($templatePaths);
        $answer = <<<EOD
Hello
EOD;
        $result = $viewManager->render($templateName);
        $answer = str_replace(array("\r","\n"), array("",""), $answer);
        $result = str_replace(array("\r","\n"), array("",""), $result);
        $this->assertEquals($answer,$result);
    }

    public function testStreamModeView()
    {
        $config = array(
            'container' => array(
                'components' => array(
                    'ViewManager' => array(
                        'properties' => array(
                            'stream' => array('value'=>true),
                        ),
                    ),
                ),
            ),
            'web' => array(
                'view' => array(
                    'template_paths' => array(
                        'default' => self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global',
                        'foo'     => self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local',
                    ),
                ),
            ),
        );
        $container = $this->getContainer($config);
        $viewManager = $container->get('ViewManager');
        $viewManager->setCurrentTemplatePaths($config['web']['view']['template_paths']);
        $templateName = 'index/index';
        $variables = array(
            'test' => 'abc',
        );
        $answer = <<<EOD
abc
EOD;
        $result = stream_get_contents($viewManager->render($templateName,$variables));
        $answer = str_replace(array("\r","\n"), array("",""), $answer);
        $result = str_replace(array("\r","\n"), array("",""), $result);
        $this->assertEquals($answer,$result);
    }

    public function testStreamModeRenderLayout()
    {
        $config = array(
            'container' => array(
                'components' => array(
                    'ViewManager' => array(
                        'properties' => array(
                            'stream' => array('value'=>true),
                        ),
                    ),
                ),
            ),
            'web' => array(
                'view' => array(
                    'layout' => 'layout/layout',
                    'template_paths' => array(
                        'default' => self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global',
                        'foo'     => self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local',
                    ),
                ),
            ),
        );
        $container = $this->getContainer($config);
        $viewManager = $container->get('ViewManager');
        $viewManager->setCurrentTemplatePaths($config['web']['view']['template_paths']);
        $variables = array('test'=>'abc');
        $templateName = 'index/index';
        $variables = array(
            'test' => 'abc',
        );
        $answer = <<<EOD
<html>
<head>
<title>Test</title>
</head>
<body>
abc
</body>
</html>
EOD;
        $result = stream_get_contents($viewManager->render($templateName,$variables));
        $answer = str_replace(array("\r","\n"), array("",""), $answer);
        $result = str_replace(array("\r","\n"), array("",""), $result);
        $this->assertEquals($answer,$result);
    }
/*
    public function testSyntaxError()
    {
        $templateName = 'index/syntaxerror';
        $templatePaths = array(
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/local',
            self::$RINDOW_TEST_RESOURCES.'/AcmeTest/Web/View/Resources/views/global',
        );
        $variables = array(
            'test' => 'abc',
        );
        $viewManager = new ViewManager(array(),new PluginManager(array(),new Container()));
        $answer = <<<EOD
abc
EOD;
        $result = $viewManager->render($templateName,$variables,$templatePaths);
        $answer = str_replace(array("\r","\n"), array("",""), $answer);
        $result = str_replace(array("\r","\n"), array("",""), $result);
        $this->assertEquals($answer,$result);
    }
*/
}
