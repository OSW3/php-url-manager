<?php 
namespace OSW3\UrlManager\Components;

use OSW3\UrlManager\Helper;
use OSW3\UrlManager\Abstract\AbstractComponent;

class Fragment extends AbstractComponent
{
    protected function parser(): array
    {
        $response = array_merge(Helper::RESPONSE, [
            'identifier' => null,
            'parameters' => array(
                'size'    => 0,
                'entries' => array(),
            ),
        ]);

        $url = str_replace("&amp;", Helper::QUERY_SEPARATOR, $this->getSubject());
        $delimiters = $this->queryDelimiters($url, Helper::FRAGMENT_IDENTIFIER);

        if ( $delimiters['start'] > 0 && $delimiters['end'] > 0)
        {
            $subject = substr($url, $delimiters['start'], $delimiters['end']);
            $parameters = $this->parseParameters(substr($subject, 1));
            
            $response = $this->standardParser($subject, [
                'identifier' => Helper::FRAGMENT_IDENTIFIER,
                'parameters' => array(
                    'size' => count($parameters),
                    'entries' => $parameters,
                ),
            ]);
        }

        return $response;
    }
}