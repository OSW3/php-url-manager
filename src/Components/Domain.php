<?php 
namespace OSW3\UrlManager\Components;

use OSW3\UrlManager\Components\Host;
use OSW3\UrlManager\Abstract\AbstractComponent;

class Domain extends AbstractComponent
{
    protected function parser(): array
    {
        $host    = (new Host($this->getSubject()))->get('subject');
        $exp     = explode(".", $host);
        $subject = array_shift($exp);
        
        return $this->standardParser($subject);
    }
}