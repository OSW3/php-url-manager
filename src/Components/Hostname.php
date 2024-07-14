<?php 
namespace OSW3\UrlManager\Components;

use OSW3\UrlManager\Helper;
use OSW3\UrlManager\Components\Authority;
use OSW3\UrlManager\Abstract\AbstractComponent;

class Hostname extends AbstractComponent
{
    protected function parser(): array
    {
        $response  = Helper::RESPONSE;
        $authority = (new Authority($this->getSubject()))->get('subject');
        $exp       = explode("@", $authority);
        $subject   = end($exp);
        
        if ($pos = strpos($subject, ":"))
            $subject = substr($subject, 0, $pos);
        
        return array_merge($response, $this->standardParser($subject));
    }
}