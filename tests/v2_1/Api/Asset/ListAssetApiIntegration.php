<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\v2_1\Api\Asset;

use Akeneo\Pim\ApiClient\Pagination\PageInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;
use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class ListAssetApiIntegration extends ApiTestCase
{
    public function testListAll()
    {
        $api = $this->createClient()->getAssetApi();
        $assets = $api->all();

        $this->assertInstanceOf(ResourceCursorInterface::class, $assets);
        $assets = iterator_to_array($assets);

        $this->assertCount(3, $assets);
        $this->assertSameContent($this->getExpectedAssets(), $assets);
    }

    public function testAllWithUselessQueryParameter()
    {
        $api = $this->createClient()->getAssetApi();
        $assets = $api->all(10, ['foo' => 'bar']);

        $this->assertInstanceOf(ResourceCursorInterface::class, $assets);
        $assets = iterator_to_array($assets);

        $this->assertCount(3, $assets);
        $this->assertSameContent($this->getExpectedAssets(), $assets);
    }

    public function testListPerPage()
    {
        $api = $this->createClient()->getAssetApi();
        $baseUri = $this->getConfiguration()['pim']['base_uri'];
        $expectedAssets = $this->getExpectedAssets();

        $firstPage = $api->listPerPage(2);
        $this->assertInstanceOf(PageInterface::class, $firstPage);
        $this->assertNull($firstPage->getCount());
        $this->assertNull($firstPage->getPreviousLink());
        $this->assertNull($firstPage->getPreviousPage());
        $this->assertFalse($firstPage->hasPreviousPage());
        $this->assertTrue($firstPage->hasNextPage());
        $this->assertSame($baseUri . '/api/rest/v1/assets?page=2&with_count=false&pagination_type=page&limit=2', $firstPage->getNextLink());

        $assets = $firstPage->getItems();
        $this->assertCount(2 ,$assets);
        $this->assertSameContent($expectedAssets[0], $assets[0]);
        $this->assertSameContent($expectedAssets[1], $assets[1]);

        $secondPage = $firstPage->getNextPage();
        $this->assertInstanceOf(PageInterface::class, $secondPage);
        $this->assertTrue($secondPage->hasPreviousPage());
        $this->assertFalse($secondPage->hasNextPage());
        $this->assertSame($baseUri . '/api/rest/v1/assets?page=1&with_count=false&pagination_type=page&limit=2', $secondPage->getPreviousLink());
        $this->assertNull($secondPage->getNextLink());
        $this->assertNull($secondPage->getNextPage());

        $assets = $secondPage->getItems();
        $this->assertCount(1 ,$assets);
        $this->assertSameContent($expectedAssets[2], $assets[0]);

        $previousPage = $secondPage->getPreviousPage();
        $this->assertInstanceOf(PageInterface::class, $previousPage);
        $this->assertSame($firstPage->getItems(), $previousPage->getItems());
    }

    public function testListPerPageWithSpecificQueryParameter()
    {
        $api = $this->createClient()->getAssetApi();
        $expectedAssets = $this->getExpectedAssets();
        $baseUri = $this->getConfiguration()['pim']['base_uri'];

        $firstPage = $api->listPerPage(2, false, ['foo' => 'bar']);

        $this->assertInstanceOf(PageInterface::class, $firstPage);
        $this->assertSame($baseUri . '/api/rest/v1/assets?page=2&with_count=false&pagination_type=page&limit=2&foo=bar', $firstPage->getNextLink());
        $assets = $firstPage->getItems();
        $this->assertCount(2 ,$assets);
        $this->assertSameContent($expectedAssets[0], $assets[0]);
        $this->assertSameContent($expectedAssets[1], $assets[1]);
    }

    protected function getExpectedAssets()
    {
        $baseUri = $this->getConfiguration()['pim']['base_uri'];

        return [
            [
                '_links' => [
                    'self' => [
                        'href' => $baseUri . '/api/rest/v1/assets/akeneo_logo',
                    ],
                ],
                'code' => 'akeneo_logo',
                'localizable' => false,
                'description' => 'Akeneo logo',
                'end_of_use' => null,
                'tags' => [],
                'categories' => ['asset_main_catalog'],
                'variation_files' => [],
                'reference_files' => [],
            ],
            [
                '_links' => [
                    'self' => [
                        'href' => $baseUri . '/api/rest/v1/assets/ziggy',
                    ],
                ],
                'code' => 'ziggy',
                'localizable' => true,
                'description' => null,
                'end_of_use' => null,
                'tags' => [],
                'categories' => [
                    'asset_main_catalog',
                    'asset_winter',
                ],
                'variation_files' => [],
                'reference_files' => [],
            ],
            [
                '_links' => [
                    'self' => [
                        'href' => $baseUri . '/api/rest/v1/assets/ziggy_certif',
                    ],
                ],
                'code' => 'ziggy_certif',
                'localizable' => false,
                'description' => 'Ziggy certification',
                'end_of_use' => '2042-06-12T00:00:00+00:00',
                'tags' => [],
                'categories' => [],
                'variation_files' => [],
                'reference_files' => [],
            ],
        ];
    }
}
