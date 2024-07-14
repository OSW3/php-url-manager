<?php 
namespace OSW3\UrlManager;

final class Helper 
{
    public const SCHEME_IDENTIFIER   = "://";
    public const FRAGMENT_IDENTIFIER = "#";
    public const QUERY_IDENTIFIER    = "?";
    public const QUERY_SEPARATOR     = "&";

    public const RESPONSE = array(
        'subject'   => "",
        'hash'      => "",
        'length'    => 0,
        'positions' => array(
            'start' => null,
            'end'   => null,
        ),
    );

    public const ALGORITHMS = array(
        'md5'
    );
}