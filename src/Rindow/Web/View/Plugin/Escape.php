<?php
namespace Rindow\Web\View\Plugin;

class Escape
{
    public function __invoke($content)
    {
        return htmlspecialchars($content,ENT_QUOTES,'UTF-8');
    }
}
