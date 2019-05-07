<?php
namespace Rindow\Web\View;

use Rindow\Web\View\Exception;

class View
{
    public $headers;
	public $content;
	public $layout;
	protected $pluginManager;
    protected $stream;

	public function __construct($pluginManager,$stream=null)
	{
		$this->pluginManager = $pluginManager;
        $this->stream = $stream;
	}

/******************************************************************
 ******** Errors disapper when template includes a syntax error. 
 ********
    public function renderTemplate($templateFullPath,$templateVariables)
    {
        if(is_array($templateVariables))
            extract($templateVariables,EXTR_PREFIX_SAME,'var_');
        try {
            $stream = fopen('php://temp','w+b');
            $callback = function($string) use ($stream) {
               if(fwrite($stream, $string)===false) {
                   throw new Exception\RuntimeException('write error to tempfile');
               }
               return true;
            };
            
            ob_start($callback);
            require $templateFullPath;
            ob_get_clean();

            if(fwrite($stream, $string)===false) {
                throw new Exception\RuntimeException('write error to tempfile');
            }
            fseek($stream, 0);
            if($this->stream) {
                $output = $stream;
            } else {
                $output = stream_get_contents($stream);
                fclose($stream);
            }
            return $output;
        }
        catch(\Exception $e) {
            ob_end_clean();
            if(isset($stream))
                fclose($stream);
            throw $e;
        }
    }
******************************************************************/

    public function renderTemplate($templateFullPath,$templateVariables)
    {
        if(is_array($templateVariables))
            extract($templateVariables,EXTR_PREFIX_SAME,'var_');
        try {
            ob_start();
            require $templateFullPath;
            $output = ob_get_clean();

            if($this->stream) {
                if(($stream = fopen('php://temp','w+b'))===false)
                    throw new Exception\RuntimeException('open error tempfile');
                if(fwrite($stream, $output)===false)
                    throw new Exception\RuntimeException('write error to tempfile');
                fseek($stream, 0);
                return $stream;
            }
            return $output;
        }
        catch(\Exception $e) {
            ob_end_clean();
            if(isset($stream))
                fclose($stream);
            throw $e;
        }
    }

    public function displayContent($content)
    {
        if(!is_resource($content)) {
            echo $content;
            return;
        }
        if(fseek($content, 0)===false)
            throw new Exception\RuntimeException('seek error: content stream');
        while($string=fread($content, 8192)) {
            echo $string;
        }
    }

    public function __call($method,$params)
    {
        if($this->pluginManager==null)
            throw new Exception\DomainException('pluginManager is not specified.');
        $plugin = $this->pluginManager->get($method);
        if (is_callable($plugin)) {
            return call_user_func_array($plugin, $params);
        }

        return $plugin;
    }
}