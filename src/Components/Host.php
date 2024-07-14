<?php 
namespace OSW3\UrlManager\Components;

use OSW3\UrlManager\Components\Hostname;
use OSW3\UrlManager\Abstract\AbstractComponent;

class Host extends AbstractComponent
{
    protected function parser(): array
    {
        $hostname = (new Hostname($this->getSubject()))->get('subject');
        $re       = "/[a-z0-9\-]{1,63}\.[a-z\.]{2,6}$/";
        preg_match($re, $hostname, $matches);

        $subject = isset($matches[0]) ? $matches[0] : "";

        return $this->standardParser($subject);
    }
}