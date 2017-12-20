<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\Common\Api\AssetCategory;

use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class UpsertListAssetCategoryApiIntegration extends ApiTestCase
{
    public function testUpsertListSuccessful()
    {
        $api = $this->createClient()->getAssetCategoryApi();
        $response = $api->upsertList([
            [
                'code' => 'asset_main_catalog',
                'labels' => [
                    'en_US' => 'Nullam ullamcorper',
                ],
            ],
            [
                'code' => 'asset_cold',
                'parent' => 'asset_winter',
                'labels' => [
                    'en_US' => 'Aenean ultricies elit',
                ],
            ]
        ]);

        $this->assertInstanceOf('\Iterator', $response);

        $responseLines = iterator_to_array($response);
        $this->assertCount(2, $responseLines);

        $this->assertSame([
            'line'        => 1,
            'code'        => 'asset_main_catalog',
            'status_code' => 204,
        ], $responseLines[1]);

        $this->assertSame([
            'line'        => 2,
            'code'        => 'asset_cold',
            'status_code' => 201,
        ], $responseLines[2]);
    }

    public function testUpsertListFailed()
    {
        $api = $this->createClient()->getChannelApi();
        $response = $api->upsertList([
            [
                'labels' => [
                    'en_US' => 'Nullam ullamcorper',
                ],
            ]
        ]);

        $this->assertInstanceOf('\Iterator', $response);

        $responseLines = iterator_to_array($response);
        $this->assertCount(1, $responseLines);

        $this->assertSame([
            'line'        => 1,
            'status_code' => 422,
            'message'     => 'Code is missing.',
        ], $responseLines[1]);
    }
}
