#!/usr/bin/env php
<?php

use Akeneo\PimEnterprise\ApiClient\Search\SharedCatalogBuilder;
use Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientBuilder;

require __DIR__.'/vendor/autoload.php';

$client = (new AkeneoPimEnterpriseClientBuilder('http://localhost:8080'))->buildAuthenticatedByPassword(
    '100_31vivndw1q80kc0w8csogwgc0wss0oo48wks0coowkskwggo08',
    '2nrok2qzaoo4w8kwosk8ooc8g80sogsgc4owko08s0sc0sco0o',
    'admin',
    'admin'
);

$catalogs = $client->getCatalogApi()->all();
$catalogCode = $catalogs[0]['code'];

$products = $client->getSharedCatalogApi()->search($catalogCode, 50);

foreach ($products as $product) {
    var_dump($product);
}
