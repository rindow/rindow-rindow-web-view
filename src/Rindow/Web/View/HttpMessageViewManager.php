<?php
namespace Rindow\Web\View;

use Psr\Http\Message\ResponseInterface;

class HttpMessageViewManager extends ViewManager
{
    public function renderToMessage(
        ResponseInterface $response,
        $templateName,
        array $variables=null,
        $templatePaths=null)
    {
        $output = $this->render($templateName,$variables,$templatePaths);
        if(is_resource($output)) {
            $resource = $response->getBody()->detach();
            stream_copy_to_stream($output, $resource);
            fclose($output);
            $response->getBody()->attach($output);
        } else {
            $response->write($output);
        }
        return $response;
    }
}