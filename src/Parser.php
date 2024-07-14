<?php 
namespace OSW3\UrlManager;

use OSW3\UrlManager\Components\Tld;
use OSW3\UrlManager\Components\Url;
use OSW3\UrlManager\Components\Host;
use OSW3\UrlManager\Components\Path;
use OSW3\UrlManager\Components\Port;
use OSW3\UrlManager\Components\Query;
use OSW3\UrlManager\Components\Domain;
use OSW3\UrlManager\Components\Scheme;
use OSW3\UrlManager\Components\Fragment;
use OSW3\UrlManager\Components\Hostname;
use OSW3\UrlManager\Components\Password;
use OSW3\UrlManager\Components\Protocol;
use OSW3\UrlManager\Components\Username;
use OSW3\UrlManager\Components\Authority;
use OSW3\UrlManager\Components\SubDomain;

class Parser
{
    private array $components;

    public function __construct(string $subject)
    {
        $this->components = array(
            'url'       => new Url($subject),
            'scheme'    => new Scheme($subject),
            'protocol'  => new Protocol($subject),
            'authority' => new Authority($subject),
            'username'  => new Username($subject),
            'password'  => new Password($subject),
            'hostname'  => new Hostname($subject),
            'host'      => new Host($subject),
            'tld'       => new Tld($subject),
            'domain'    => new Domain($subject),
            'subdomain' => new SubDomain($subject),
            'port'      => new Port($subject),
            'path'      => new Path($subject),
            'query'     => new Query($subject),
            'fragment'  => new Fragment($subject),
        );
    }

    public function infos(bool $asArray = false, bool $condensed = true): object|array
    {
        $response = array();

        foreach ($this->components as $name => $component) $response[$name] = $condensed 
            ? $component->get('subject') 
            : $component->infos()
        ;

        return $asArray 
            ? $response 
            : json_decode(json_encode($response))
        ;
    }

    public function fetch(string $component, bool $subjectOnly = true): null|object|array|string
    {
        $data = null;

        if (isset($this->components[$component]))
        {
            if ($subjectOnly)
            {
                $data = $this->components[$component]->get('subject');
            }
            else {
                $data = $this->components[$component]->infos();
            }
        }

        return $data;
    }

}