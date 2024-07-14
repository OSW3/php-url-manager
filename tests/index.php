<?php

require __DIR__ . "/../vendor/autoload.php";

use OSW3\UrlManager\Parser;
use OSW3\UrlManager\Components\Tld;
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
use OSW3\UrlManager\Components\Url;

$subject = require __DIR__ . "/data.php";

$parser    = new Parser($subject);
$url       = new Url($subject);
$scheme    = new Scheme($subject);
$protocol  = new Protocol($subject);
$authority = new Authority($subject);
$username  = new Username($subject);
$password  = new Password($subject);
$hostname  = new Hostname($subject);
$host      = new Host($subject);
$tld       = new Tld($subject);
$domain    = new Domain($subject);
$subdomain = new SubDomain($subject);
$port      = new Port($subject);
$path      = new Path($subject);
$query     = new Query($subject);
$fragment  = new Fragment($subject);

print_r("\n--- All data result -------------------------------------------\n\n");
$asArray = false;
$condensed = true;
print_r( $parser->infos($asArray, $condensed) );
print_r( $parser->fetch('authority') );

// print_r("\n--- URL result ------------------------------------------------\n\n");
// print_r( $url->infos() );

print_r("\n--- Scheme result ---------------------------------------------\n\n");
// print_r( $scheme->infos() );
print_r( $scheme->get('subject') );

// print_r("\n--- Protocol result -------------------------------------------\n\n");
// print_r( $protocol->infos() );

// print_r("\n--- Authority result ------------------------------------------\n\n");
// print_r( $authority->infos() );

// print_r("\n--- Username result -------------------------------------------\n\n");
// print_r( $username->infos() );

// print_r("\n--- Password result -------------------------------------------\n\n");
// print_r( $password->infos() );

// print_r("\n--- Hostname result -------------------------------------------\n\n");
// print_r( $hostname->infos() );

// print_r("\n--- Host result -----------------------------------------------\n\n");
// print_r( $host->infos() );

// print_r("\n--- Tld result ------------------------------------------------\n\n");
// print_r( $tld->infos() );

// print_r("\n--- Domain result ---------------------------------------------\n\n");
// print_r( $domain->infos() );

// print_r("\n--- Subdomain result ------------------------------------------\n\n");
// print_r( $subdomain->infos() );

// print_r("\n--- Port result -----------------------------------------------\n\n");
// print_r( $port->infos() );

// print_r("\n--- Path result -----------------------------------------------\n\n");
// print_r( $path->infos() );

// print_r("\n--- Query result ----------------------------------------------\n\n");
// print_r( $query->infos() );

// print_r("\n--- Fragment result -------------------------------------------\n\n");
// print_r( $fragment->infos() );