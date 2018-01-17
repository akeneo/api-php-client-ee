<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\v2_1\Api\AssetCategory;

use Akeneo\Pim\ApiClient\Pagination\PageInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;
use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class ListAssetCategoryApiIntegration extends ApiTestCase
{
    public function testListAll()
    {
        $api = $this->createClient()->getAssetCategoryApi();
        $assetCategories = $api->all();

        $this->assertInstanceOf(ResourceCursorInterface::class, $assetCategories);

        $assetCategories = iterator_to_array($assetCategories);

        $this->assertCount(3, $assetCategories);
        $this->assertSameContent($this->getExpectedAssetCategories(), $assetCategories);
    }

    public function testAllWithUselessQueryParameter()
    {
        $api = $this->createClient()->getAssetCategoryApi();
        $assetCategories = $api->all(10, ['foo' => 'bar']);

        $this->assertInstanceOf(ResourceCursorInterface::class, $assetCategories);

        $assetCategories = iterator_to_array($assetCategories);

        $this->assertCount(3, $assetCategories);
        $this->assertSameContent($this->getExpectedAssetCategories(), $assetCategories);
    }

    public function testListPerPage()
    {
        $api = $this->createClient()->getAssetCategoryApi();
        $baseUri = $this->getConfiguration()['pim']['base_uri'];
        $expectedAssetCategories = $this->getExpectedAssetCategories();

        $firstPage = $api->listPerPage(2);
        $this->assertInstanceOf(PageInterface::class, $firstPage);
        $this->assertNull($firstPage->getCount());
        $this->assertNull($firstPage->getPreviousLink());
        $this->assertNull($firstPage->getPreviousPage());
        $this->assertFalse($firstPage->hasPreviousPage());
        $this->assertTrue($firstPage->hasNextPage());
        $this->assertSame($baseUri . '/api/rest/v1/asset-categories?page=2&limit=2&with_count=false', $firstPage->getNextLink());

        $assetCategories = $firstPage->getItems();
        $this->assertCount(2 ,$assetCategories);
        $this->assertSameContent($expectedAssetCategories[0], $assetCategories[0]);
        $this->assertSameContent($expectedAssetCategories[1], $assetCategories[1]);

        $secondPage = $firstPage->getNextPage();
        $this->assertInstanceOf(PageInterface::class, $secondPage);
        $this->assertTrue($secondPage->hasPreviousPage());
        $this->assertFalse($secondPage->hasNextPage());
        $this->assertSame($baseUri . '/api/rest/v1/asset-categories?page=1&limit=2&with_count=false', $secondPage->getPreviousLink());
        $this->assertNull($secondPage->getNextLink());
        $this->assertNull($secondPage->getNextPage());

        $assetCategories = $secondPage->getItems();
        $this->assertCount(1 ,$assetCategories);
        $this->assertSameContent($expectedAssetCategories[2], $assetCategories[0]);

        $previousPage = $secondPage->getPreviousPage();
        $this->assertInstanceOf(PageInterface::class, $previousPage);
        $this->assertSame($firstPage->getItems(), $previousPage->getItems());
    }

    public function testListPerPageWithSpecificQueryParameter()
    {
        $api = $this->createClient()->getAssetCategoryApi();
        $expectedAssetCategories = $this->getExpectedAssetCategories();
        $baseUri = $this->getConfiguration()['pim']['base_uri'];

        $firstPage = $api->listPerPage(2, false, ['foo' => 'bar']);

        $this->assertInstanceOf(PageInterface::class, $firstPage);
        $this->assertSame($baseUri . '/api/rest/v1/asset-categories?page=2&limit=2&with_count=false&foo=bar', $firstPage->getNextLink());

        $assetCategories = $firstPage->getItems();
        $this->assertCount(2 ,$assetCategories);
        $this->assertSameContent($expectedAssetCategories[0], $assetCategories[0]);
        $this->assertSameContent($expectedAssetCategories[1], $assetCategories[1]);
    }

    protected function getExpectedAssetCategories()
    {
        $baseUri = $this->getConfiguration()['pim']['base_uri'];

        return [
            [
                '_links' => [
                    'self' => [
                        'href' => $baseUri . '/api/rest/v1/asset-categories/asset_main_catalog',
                    ],
                ],
                'code' => 'asset_main_catalog',
                'parent' => null,
                'labels' => [
                    'en_US' => 'dolor sed perferendis',
                ],
            ],
            [
                '_links' => [
                    'self' => [
                        'href' => $baseUri . '/api/rest/v1/asset-categories/asset_summer',
                    ],
                ],
                'code' => 'asset_summer',
                'parent' => 'asset_main_catalog',
                'labels' => [
                    'en_US' => 'Maecenas tincidunt',
                ],
            ],
            [
                '_links' => [
                    'self' => [
                        'href' => $baseUri . '/api/rest/v1/asset-categories/asset_winter',
                    ],
                ],
                'code' => 'asset_winter',
                'parent' => 'asset_main_catalog',
                'labels' => [
                    'en_US' => 'Morbi non ultricies',
                ],
            ],
        ];
    }
}
