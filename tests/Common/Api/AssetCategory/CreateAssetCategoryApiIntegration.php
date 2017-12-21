<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\Common\Api\AssetCategory;

use Akeneo\Pim\ApiClient\Exception\UnprocessableEntityHttpException;
use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class CreateAssetCategoryApiIntegration extends ApiTestCase
{
    public function testCreateSuccessful()
    {
        $api = $this->createClient()->getAssetCategoryApi();

        $responseCode = $api->create('asset_spring', [
            'parent' => null,
            'labels' => [
                'en_US' => 'Nullam ullamcorper',
            ],
        ]);

        $this->assertSame(201, $responseCode);

        $assetCategory = $api->get('asset_spring');

        $this->assertSameContent([
            'code' => 'asset_spring',
            'parent' => null,
            'labels' => [
                'en_US' => 'Nullam ullamcorper',
            ],
        ], $assetCategory);
    }

    public function testCreateAnExistingAssetCategory()
    {
        $api = $this->createClient()->getAssetCategoryApi();

        try {
            $api->create('asset_main_catalog', [
                'parent' => null,
                'labels' => [
                    'en_US' => 'dolor sed perferendis',
                ],
            ]);
        } catch (UnprocessableEntityHttpException $exception) {
            $this->assertSame(
                [
                    [
                        'property' => 'code',
                        'message'  => 'This value is already used.',
                    ],
                ],
                $exception->getResponseErrors()
            );
        }
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\UnprocessableEntityHttpException
     */
    public function testCreateAnInvalidAssetCategory()
    {
        $api = $this->createClient()->getAssetCategoryApi();

        $api->create('asset_spring', [
            'parent' => 'unknown_parent',
            'labels' => [
                'en_US' => 'Nullam ullamcorper',
            ],
        ]);
    }
}
