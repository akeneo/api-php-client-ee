<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\Api\AssetFamily;

use Akeneo\PimEnterprise\ApiClient\Api\AssetFamilyApi;
use Akeneo\PimEnterprise\ApiClient\tests\Api\ApiTestCaseEnterprise;
use donatj\MockWebServer\RequestInfo;
use donatj\MockWebServer\Response;
use donatj\MockWebServer\ResponseStack;
use PHPUnit\Framework\Assert;

class UpsertAssetFamilyIntegration extends ApiTestCaseEnterprise
{
    public function test_upsert_asset_family()
    {
        $this->server->setResponseOfPath(
            '/'. sprintf(AssetFamilyApi::ASSET_FAMILY_URI, 'packshot'),
            new ResponseStack(
                new Response('', [], 201)
            )
        );

        $assetFamily = [
            'code' => 'packshot',
            'labels' => [
                'en_US' => 'Packshots'
            ]
        ];

        $api = $this->createClient()->getAssetFamilyApi();
        $response = $api->upsert('packshot', $assetFamily);

        Assert::assertSame($this->server->getLastRequest()->jsonSerialize()[RequestInfo::JSON_KEY_INPUT], json_encode($assetFamily));
        Assert::assertSame(201, $response);
    }
}
