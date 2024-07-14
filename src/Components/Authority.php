<?php 
namespace OSW3\UrlManager\Components;

use OSW3\UrlManager\Components\Protocol;
use OSW3\UrlManager\Abstract\AbstractComponent;

class Authority extends AbstractComponent
{
    protected function parser(): array
    {
        $protocol = (new Protocol($this->getSubject()))->get('subject');
        $subject  = str_replace($protocol, "", $this->getSubject());

        if ($pos = strpos($subject, "/")) 
            $subject = substr($subject, 0, $pos);
        
        return $this->standardParser($subject);
    }
}