<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\v2_1\Api\AssetTag;

use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class GetAssetTagApiIntegration extends ApiTestCase
{
    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\NotFoundHttpException
     */
    public function testGetNotFound()
    {
        $api = $this->createClient()->getAssetTagApi();

        $api->get('foo');
    }

    public function testGetAnAssetTag()
    {
        $api = $this->createClient()->getAssetTagApi();
        $api->upsert('logo');

        $assetTag = $api->get('logo');

        $this->assertSame(['code' => 'logo'], $assetTag);
    }
}
