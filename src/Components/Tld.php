<?php 
namespace OSW3\UrlManager\Components;

use OSW3\UrlManager\Components\Host;
use OSW3\UrlManager\Abstract\AbstractComponent;

class Tld extends AbstractComponent
{
    protected function parser(): array
    {
        $host    = (new Host($this->getSubject()))->get('subject');
        $exp     = explode(".", $host); array_shift($exp);
        $subject = implode(".", $exp);

        return $this->standardParser($subject);
    }
}