<?php
namespace Rindow\Web\View\Plugin;

class Placeholder
{
    protected $context;
    protected $data;

    protected function escape($value)
    {
        return htmlspecialchars($value,ENT_COMPAT,'UTF-8');
    }

    public function set($key,$value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function get($key,$default=null,$escape=true)
    {
        if(isset($this->data[$key]))
            $value = $this->data[$key];
        else
            $value = $default;
        if($escape)
            $value = $this->escape($value);
        return $value;
    }
}
