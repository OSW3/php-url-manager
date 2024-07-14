<?php 
namespace OSW3\UrlManager\Components;

use OSW3\UrlManager\Abstract\AbstractComponent;

class Url extends AbstractComponent
{
    protected function parser(): array
    {
        $response = $this->standardParser($this->getSubject());
        unset($response['positions']);
        
        return $response;
    }
}