# :warning: The Client project has moved :warning:

TL;DR: Please use [api-php-client](https://github.com/akeneo/api-php-client) instead.

This Enterprise Edition project is now merged into the main [api-php-client](https://github.com/akeneo/api-php-client) project.  
This allows easier maintainability by avoiding many duplications.

## Migrate to main package

### Switch the dependency

In `composer.json`, switch the dependency to the main [`akeneo/api-php-client`](https://packagist.org/packages/akeneo/api-php-client) package.  
The main package start supporting EE features from v8.0.0.
```json
{
  "require": {
    "akeneo/api-php-client": "^8.0.0"
  }
}
```

### Rename uses

The only breaking change is the namespace uniformization that will break `use` statements:  
`Akeneo\PimEnterprise` was renamed to `Akeneo\Pim`

You can use this command to rename all your `use` statements in your project:
```shell
find -name '*.php' -exec sed -i 's/PimEnterprise/Pim/g' {} +
# You can add a path as first argument
```

# PHP Akeneo PIM API

A simple PHP client to use the [Akeneo PIM API](https://api.akeneo.com/) with the Enterprise Edition.

Matrix compatibility:

| PIM EE version(s) | API PHP Client EE version | CI status                                                                                                                           |
|-------------------|---------------------------|-------------------------------------------------------------------------------------------------------------------------------------|
| v2.0              | v1.0                      | [![Build Status](https://travis-ci.org/akeneo/api-php-client-ee.svg?branch=1.0)](https://travis-ci.org/akeneo/api-php-client-ee)    |
| v2.1 - v2.2       | v2.0                      | [![Build Status](https://travis-ci.org/akeneo/api-php-client-ee.svg?branch=2.0)](https://travis-ci.org/akeneo/api-php-client-ee)    |
| v2.3              | v3.0                      | [![Build Status](https://travis-ci.org/akeneo/api-php-client-ee.svg?branch=3.0)](https://travis-ci.org/akeneo/api-php-client-ee)    |
| v3.0 - v3.1       | v4.0                      | [![Build Status](https://travis-ci.org/akeneo/api-php-client-ee.svg?branch=4.0)](https://travis-ci.org/akeneo/api-php-client-ee)    |
| v3.2 - v4.0       | v5.0                      | [![Build Status](https://travis-ci.org/akeneo/api-php-client-ee.svg?branch=master)](https://travis-ci.org/akeneo/api-php-client-ee) |
| v5.0              | v6.0                      | -                                                                                                                                   |
| v6.0              | v7.0                      | -                                                                                                                                   |
| -                 | master                    | -                                                                                                                                   |

Note that our PHP client is backward compatible.
For example, if your PIM is currently a v2.3, you can still use a 1.0 version of the PHP client. The new endpoints available in v2.3 will not be available in the v1.0 of the PHP client.  

## Requirements

* PHP >= 7.4
* Composer 

## Installation

We use HTTPPlug as the HTTP client abstraction layer.
In this example, we will use [Guzzle](https://github.com/guzzle/guzzle) v6 as the HTTP client implementation.

`api-php-client-ee` uses [Composer](http://getcomposer.org).
The first step to use `api-php-client-ee` is to download composer:

```bash
$ curl -s http://getcomposer.org/installer | php
```

Then, run the following command to require the library:
```bash
$ php composer.phar require akeneo/api-php-client-ee php-http/guzzle6-adapter:^2.0 http-interop/http-factory-guzzle:^1.0
```

If you want to use another HTTP client implementation, you can check [here](https://packagist.org/providers/php-http/client-implementation) the full list of HTTP client implementations. 

## Documentation

Full documentation is available on the [API website](https://api.akeneo.com/php-client/introduction.html).

## Getting started

### Initialise the client
You first need to initialise the client with your credentials client id/secret and with your user/password.

If you don't have any client id, let's take a look at [this page](https://api.akeneo.com/documentation/security.html#authentication) to create it.

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

$clientBuilder = new \Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientBuilder('http://localhost/');
$client = $clientBuilder->buildAuthenticatedByPassword('client_id', 'secret', 'admin', 'admin');
```

You can authenticate to the client with your token/refresh token as well.
```php
$client = $clientBuilder->buildAuthenticatedByToken('client_id', 'secret', 'token', 'refresh_token');
```

Getting the token and refresh token is as simple as:
```php
$client->getToken();
$client->getRefreshToken();
```

### Get a product

```php
$product = $client->getProductApi()->get('top');
echo $product['identifier']; // display "top"
```

### Get a list of products

#### By getting pages

```php
$searchBuilder = new \Akeneo\Pim\ApiClient\Search\SearchBuilder();
$searchBuilder->addFilter('enabled', '=', true);
$searchFilters = $searchBuilder->getFilters();

$firstPage = $client->getProductApi()->listPerPage(50, true, ['search' => $searchFilters]);

echo $firstPage->getCount();

foreach ($firstPage->getItems() as $product) {
    // do your stuff here
    echo $product['identifier'];
}

$nextPage = $firstPage->getNextPage();

$firstPage = $nextPage->getPreviousPage();
```

#### By getting a cursor 

```php
$searchBuilder = new \Akeneo\Pim\ApiClient\Search\SearchBuilder();
$searchBuilder->addFilter('enabled', '=', true);
$searchFilters = $searchBuilder->getFilters();

$products = $client->getProductApi()->all(50, ['search' => $searchFilters]);
foreach ($products as $product) {
    // do your stuff here
    echo $product['identifier'];
}
```

### Create a product

```php
$client->getProductApi()->create('top', ['enabled' => true]);
```

### Upsert a product

```php
$client->getProductApi()->upsert('top', ['family' => 'tshirt']);
```

### Upsert a list of of products

```php
$client->getProductApi()->upsertList([
    [
        'identifier' => 'top',
        'family' => 'tshirt',
    ],
    [
        'identifier' => 'cap',
        'categories' => ['hat'],
    ],
]);
```

## Testing

Do note that you have to delete the `composer.lock` because Doctrine dependencies are loaded.
These dependencies are different in function of the PHP version running `composer install`.

```
cp docker-compose.yml.dist docker-compose.yml
rm -rf composer.lock vendor/
docker-compose run client_72 composer install
docker-compose run client_72 bin/phpunit -c phpunit.xml.dist
docker-compose run client_72 bin/phpspec run
docker-compose run client_72 bin/php-cs-fixer fix --diff --dry-run --config=.php_cs.php -vvv
```

## Support

The support of this client is made in best effort by our Akeneo team.

If you find a bug or want to submit an improvement, don't hesitate to raise an issue on Github.
Also, you can ask questions and discuss about the PHP client with the community in the [Slack User Group](https://akeneopim-ug.slack.com/messages/web-api/).
