<?php 
namespace OSW3\UrlManager\Components;

use OSW3\UrlManager\Helper;
use OSW3\UrlManager\Components\Scheme;
use OSW3\UrlManager\Abstract\AbstractComponent;

class Protocol extends AbstractComponent
{
    protected function parser(): array
    {
        $response = Helper::RESPONSE;
        $scheme   = (new Scheme($this->getSubject()))->get('subject');

        if ($scheme)
        {
            $subject  = $scheme.Helper::SCHEME_IDENTIFIER;
            $response = array_merge($response, $this->standardParser($subject));
        }

        return $response;
    }
}