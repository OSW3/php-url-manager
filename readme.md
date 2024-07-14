# URL Manager

Provides an URL tools.

## How to install

```shell
composer require osw3/php-url-manager
```

## How to use

### The URL Parser

```php
use OSW3\UrlManager\Parser;

$parser = new Parser('https://www.site.com');
print_r( $parser->infos() );
print_r( $parser->fetch('authority') );
```

### The URL components

```php
use OSW3\UrlManager\Components\Domain;

$domain = new Domain('https://www.site.com');
print_r( $domain->infos() );
print_r( $domain->get('subject') );
```

#### Components list

- Scheme
- Protocol
- Authority
- Username
- Password
- Hostname
- Host
- Tld
- Domain
- SubDomain
- Port
- Path
- Query
- Fragment