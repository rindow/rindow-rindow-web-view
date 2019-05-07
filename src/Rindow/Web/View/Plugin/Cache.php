<?php
namespace Rindow\Web\View\Plugin;

class Cache
{
    protected $cache;

    public function __construct($cache = null)
    {
        $this->cache = $cache;
    }

    public function setCache(/*SimpleCache*/$cache)
    {
        $this->cache = $cache;
    }

    public function getCache()
    {
        return $this->cache;
    }

    public function __invoke($cacheName,$timeout,$func)
    {
        $cache = $this->getCache();
        if($cache->has($cacheName))
            return $cache->get($cacheName);

        try {
            ob_start();
            call_user_func($func);
            $output = ob_get_clean();
        }
        catch(\Exception $e) {
            ob_end_clean();
            throw $e;
        }
        $cache->set($cacheName,$output,$timeout);
        return $output;
    }
}
