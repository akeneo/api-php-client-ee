<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\v2_1\Api\Asset;

use Akeneo\Pim\ApiClient\Exception\UnprocessableEntityHttpException;
use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class CreateAssetApiIntegration extends ApiTestCase
{
    public function testCreateSuccessful()
    {
        $api = $this->createClient()->getAssetApi();
        $responseCode = $api->create('unicorn', [
            'localizable' => false,
            'description' => 'The wonderful unicorn',
            'end_of_use' => '2042-11-21',
            'tags' => [],
            'categories' => ['asset_main_catalog', 'asset_winter'],
            'variation_files' => [],
            'reference_files' => [],
        ]);

        $this->assertSame(201, $responseCode);

        $asset = $api->get('unicorn');
        $this->assertSameContent([
            'code' => 'unicorn',
            'localizable' => false,
            'description' => 'The wonderful unicorn',
            'end_of_use' => '2042-11-21T00:00:00+00:00',
            'tags' => [],
            'categories' => ['asset_main_catalog', 'asset_winter'],
            'variation_files' => [],
            'reference_files' => [],
        ], $asset);
    }

    public function testCreateAnExistingAsset()
    {
        $api = $this->createClient()->getAssetApi();

        try {
            $api->create('akeneo_logo', [
                'localizable' => false,
                'description' => 'Akeneo logo already exists',
                'end_of_use' => null,
                'tags' => [],
                'categories' => ['asset_main_catalog'],
                'variation_files' => [],
                'reference_files' => [],
            ]);
        } catch (UnprocessableEntityHttpException $exception) {
            $this->assertSame([
                [
                    'property' => 'code',
                    'message'  => 'This value is already used.',
                ],
            ], $exception->getResponseErrors());
        }
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\UnprocessableEntityHttpException
     */
    public function testCreateAnInvalidAsset()
    {
        $api = $this->createClient()->getAssetApi();

        $api->create('unicorn', [
            'localizable' => false,
            'description' => 'The wonderful unicorn',
            'end_of_use' => '2042-11-21',
            'tags' => [],
            'categories' => ['unknown_category'],
            'variation_files' => [],
            'reference_files' => [],
        ]);
    }
}
