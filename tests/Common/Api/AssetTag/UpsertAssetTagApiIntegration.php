<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\Common\Api\AssetTag;

use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class UpsertAssetTagApiIntegration extends ApiTestCase
{
    public function testUpsertDoingCreate()
    {
        $api = $this->createClient()->getAssetTagApi();

        $response = $api->upsert('logo');

        $this->assertSame(201, $response);

        $assetTag = $api->get('logo');
        $this->assertSame(['code' => 'logo'], $assetTag);
    }


    public function testUpsertDoingUpdate()
    {
        $api = $this->createClient()->getAssetTagApi();
        $api->upsert('logo');

        $responseCode = $api->upsert('logo');

        $this->assertSame(204, $responseCode);
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\UnprocessableEntityHttpException
     */
    public function testUpsertInvalidCode()
    {
        $api = $this->createClient()->getAssetTagApi();
        $api->upsert('invalid-tag');
    }
}
