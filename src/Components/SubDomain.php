<?php 
namespace OSW3\UrlManager\Components;

use OSW3\UrlManager\Components\Host;
use OSW3\UrlManager\Components\Hostname;
use OSW3\UrlManager\Abstract\AbstractComponent;

class SubDomain extends AbstractComponent
{
    protected function parser(): array
    {
        $hostname = (new Hostname($this->getSubject()))->get('subject');
        $host     = (new Host($this->getSubject()))->get('subject');
        $subject  = substr(str_replace($host, "", $hostname), 0, -1);
        
        return $this->standardParser($subject);
    }
}