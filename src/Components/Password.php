<?php 
namespace OSW3\UrlManager\Components;

use OSW3\UrlManager\Helper;
use OSW3\UrlManager\Components\Authority;
use OSW3\UrlManager\Abstract\AbstractComponent;

class Password extends AbstractComponent
{
    protected function parser(): array
    {
        $response  = Helper::RESPONSE;
        $authority = (new Authority($this->getSubject()))->get('subject');
        $exp       = explode("@", $authority);

        if (count($exp) >= 2)
        {
            $subject = $exp[0];

            if ($pos = strpos($subject, ":"))
            {
                $subject = substr($subject, $pos + 1);
                $response = array_merge($response, $this->standardParser($subject));
            }
        }

        return $response;
    }
}