<?php 
namespace OSW3\UrlManager\Components;

use OSW3\UrlManager\Helper;
use OSW3\UrlManager\Components\Authority;
use OSW3\UrlManager\Abstract\AbstractComponent;

class Port extends AbstractComponent
{
    protected function parser(): array
    {
        $response = Helper::RESPONSE;

        $authority = (new Authority($this->getSubject()))->get('subject');
        $exp = explode("@", $authority);
        $subject = end($exp);

        if ($pos = strpos($subject, ":"))
        {
            $subject = substr($subject, $pos + 1);
            $response = $this->standardParser($subject);
        }

        if ($response['subject'] === null)
        {
            $scheme =  (new Scheme($this->getSubject()))->get('subject');
            switch ($scheme)
            {
                case 'ftp':   $subject = 21; break;
                case 'ssh':   $subject = 22; break;
                case 'https': $subject = 443; break;
                default:
                case 'http':  $subject = 80; break;
            }

            $response = $this->standardParser($subject);
        }
        
        unset($response['hash']);
        unset($response['length']);
        return $response;
    }
}