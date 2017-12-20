<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\Common\Api\Asset;

use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class GetAssetApiIntegration extends ApiTestCase
{
    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\NotFoundHttpException
     */
    public function testGetNotFound()
    {
        $api = $this->createClient()->getAssetApi();
        $api->get('foo');
    }

    public function testGetAnAsset()
    {
        $api = $this->createClient()->getAssetApi();
        $asset = $api->get('akeneo_logo');
        $expectedAsset = [
            'code' => 'akeneo_logo',
            'localized' => false,
            'description' => 'Akeneo logo',
            'end_of_use' => null,
            'tags' => [],
            'categories' => ['asset_main_catalog'],
            'variation_files' => [],
            'reference_files' => [],
        ];

        $this->assertSameContent($expectedAsset, $asset);
    }
}
