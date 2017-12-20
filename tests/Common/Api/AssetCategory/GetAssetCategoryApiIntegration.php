<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\Common\Api\AssetCategory;

use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class GetAssetCategoryApiIntegration extends ApiTestCase
{
    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\NotFoundHttpException
     */
    public function testGetNotFound()
    {
        $api = $this->createClient()->getAssetCategoryApi();

        $api->get('foo');
    }

    public function testGetAnAssetCategory()
    {
        $api = $this->createClient()->getAssetCategoryApi();
        $assetCategory = $api->get('asset_main_catalog');

        $expectedAssetCategory = [
            'code' => 'asset_main_catalog',
            'parent' => null,
            'labels' => [
                'en_US' => 'dolor sed perferendis',
            ],
        ];

        $this->assertSameContent($expectedAssetCategory, $assetCategory);
    }
}
