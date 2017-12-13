<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\Common\Api\AssetCategory;

use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class UpsertAssetCategoryApiIntegration extends ApiTestCase
{
    public function testUpsertDoingUpdate()
    {
        $api = $this->createClient()->getAssetCategoryApi();

        $response = $api->upsert('asset_main_catalog',[
            'labels' => [
                'en_US' => 'Nullam ullamcorper',
            ]
        ]);

        $this->assertSame(204, $response);

        $assetCategory = $api->get('asset_main_catalog');
        $this->assertSameContent(
            [
                'code' => 'asset_main_catalog',
                'parent' => null,
                'labels' => [
                    'en_US' => 'Nullam ullamcorper',
                ],
            ],
            $assetCategory
        );
    }

    public function testUpsertDoingCreate()
    {
        $api = $this->createClient()->getAssetCategoryApi();

        $response = $api->upsert('asset_cold',[
            'parent' => 'asset_winter',
            'labels' => [
                'en_US' => 'Aenean ultricies elit',
            ],
        ]);

        $this->assertSame(201, $response);

        $assetCategory = $api->get('asset_cold');
        $this->assertSameContent(
            [
                'code' => 'asset_cold',
                'parent' => 'asset_winter',
                'labels' => [
                    'en_US' => 'Aenean ultricies elit',
                ],
            ],
            $assetCategory
        );
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\UnprocessableEntityHttpException
     */
    public function testUpsertInvalidData()
    {
        $api = $this->createClient()->getChannelApi();
        $api->upsert('asset_cold',[
            'parent' => 'unknown_asset',
            'labels' => [
                'en_US' => 'Aenean ultricies elit',
            ],
        ]);
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\UnprocessableEntityHttpException
     */
    public function testUpsertInvalidCodeFail()
    {
        $api = $this->createClient()->getChannelApi();
        $api->upsert('invalid code !');
    }
}
