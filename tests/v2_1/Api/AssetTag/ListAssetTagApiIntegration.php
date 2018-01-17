<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\v2_1\Api\AssetTag;

use Akeneo\Pim\ApiClient\Pagination\PageInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;
use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class ListAssetTagApiIntegration extends ApiTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $api = $this->createClient()->getAssetTagApi();
        $api->upsert('ziggy');
        $api->upsert('winter');
        $api->upsert('popeye');
    }

    public function testListAll()
    {
        $api = $this->createClient()->getAssetTagApi();
        $assetTags = $api->all();

        $this->assertInstanceOf(ResourceCursorInterface::class, $assetTags);

        $assetTags = iterator_to_array($assetTags);

        $this->assertCount(3, $assetTags);
        $this->assertSameContent($this->getExpectedAssetTags(), $assetTags);
    }

    public function testAllWithUselessQueryParameter()
    {
        $api = $this->createClient()->getAssetTagApi();
        $assetTags = $api->all(10, ['foo' => 'bar']);

        $this->assertInstanceOf(ResourceCursorInterface::class, $assetTags);

        $assetTags = iterator_to_array($assetTags);

        $this->assertCount(3, $assetTags);
        $this->assertSameContent($this->getExpectedAssetTags(), $assetTags);
    }

    public function testListPerPage()
    {
        $api = $this->createClient()->getAssetTagApi();
        $baseUri = $this->getConfiguration()['pim']['base_uri'];
        $expectedAssetTags = $this->getExpectedAssetTags();

        $firstPage = $api->listPerPage(2);
        $this->assertInstanceOf(PageInterface::class, $firstPage);
        $this->assertNull($firstPage->getCount());
        $this->assertNull($firstPage->getPreviousLink());
        $this->assertNull($firstPage->getPreviousPage());
        $this->assertFalse($firstPage->hasPreviousPage());
        $this->assertTrue($firstPage->hasNextPage());
        $this->assertSame($baseUri . '/api/rest/v1/asset-tags?page=2&limit=2&with_count=false', $firstPage->getNextLink());

        $assetTags = $firstPage->getItems();
        $this->assertCount(2 ,$assetTags);
        $this->assertSameContent($expectedAssetTags[0], $assetTags[0]);
        $this->assertSameContent($expectedAssetTags[1], $assetTags[1]);

        $secondPage = $firstPage->getNextPage();
        $this->assertInstanceOf(PageInterface::class, $secondPage);
        $this->assertTrue($secondPage->hasPreviousPage());
        $this->assertFalse($secondPage->hasNextPage());
        $this->assertSame($baseUri . '/api/rest/v1/asset-tags?page=1&limit=2&with_count=false', $secondPage->getPreviousLink());
        $this->assertNull($secondPage->getNextLink());
        $this->assertNull($secondPage->getNextPage());

        $assetTags = $secondPage->getItems();
        $this->assertCount(1 ,$assetTags);
        $this->assertSameContent($expectedAssetTags[2], $assetTags[0]);

        $previousPage = $secondPage->getPreviousPage();
        $this->assertInstanceOf(PageInterface::class, $previousPage);
        $this->assertSame($firstPage->getItems(), $previousPage->getItems());
    }

    public function testListPerPageWithSpecificQueryParameter()
    {
        $api = $this->createClient()->getAssetTagApi();
        $expectedAssetTags = $this->getExpectedAssetTags();
        $baseUri = $this->getConfiguration()['pim']['base_uri'];

        $firstPage = $api->listPerPage(2, false, ['foo' => 'bar']);

        $this->assertInstanceOf(PageInterface::class, $firstPage);
        $this->assertSame($baseUri . '/api/rest/v1/asset-tags?page=2&limit=2&with_count=false&foo=bar', $firstPage->getNextLink());

        $assetTags = $firstPage->getItems();
        $this->assertCount(2 ,$assetTags);
        $this->assertSameContent($expectedAssetTags[0], $assetTags[0]);
        $this->assertSameContent($expectedAssetTags[1], $assetTags[1]);
    }

    protected function getExpectedAssetTags()
    {
        $baseUri = $this->getConfiguration()['pim']['base_uri'];

        return [
            [
                'code' => 'popeye',
                '_links' => [
                    'self' => [
                        'href' => $baseUri . '/api/rest/v1/asset-tags/popeye',
                    ],
                ],
            ],
            [
                'code' => 'winter',
                '_links' => [
                    'self' => [
                        'href' => $baseUri . '/api/rest/v1/asset-tags/winter',
                    ],
                ],
            ],
            [
                'code' => 'ziggy',
                '_links' => [
                    'self' => [
                        'href' => $baseUri . '/api/rest/v1/asset-tags/ziggy',
                    ],
                ],
            ]
        ];
    }
}
