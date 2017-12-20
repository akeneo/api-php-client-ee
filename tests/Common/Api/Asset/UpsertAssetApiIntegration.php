<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\Common\Api\Asset;

use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class UpsertAssetApiIntegration extends ApiTestCase
{
    public function testUpsertDoingUpdate()
    {
        $api = $this->createClient()->getAssetApi();

        $responseCode = $api->upsert('akeneo_logo', [
            'description' => 'Akeneo logo updated',
            'categories' => ['asset_winter'],
            'tags' => []
        ]);

        $this->assertSame(204, $responseCode);

        $asset = $api->get('akeneo_logo');
        $this->assertSameContent([
            'code' => 'akeneo_logo',
            'localized' => false,
            'description' => 'Akeneo logo updated',
            'end_of_use' => null,
            'tags' => [],
            'categories' => ['asset_winter'],
            'variation_files' => [],
            'reference_files' => [],
        ], $asset);
    }

    public function testUpsertDoingCreate()
    {
        $api = $this->createClient()->getAssetApi();

        $responseCode = $api->upsert('unicorn', [
            'localized' => false,
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
            'localized' => false,
            'description' => 'The wonderful unicorn',
            'end_of_use' => '2042-11-21T00:00:00+00:00',
            'tags' => [],
            'categories' => ['asset_main_catalog', 'asset_winter'],
            'variation_files' => [],
            'reference_files' => [],
        ], $asset);
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\UnprocessableEntityHttpException
     */
    public function testUpsertInvalidData()
    {
        $api = $this->createClient()->getAssetApi();
        $api->upsert('akeneo_logo', [
            'description' => 'Akeneo logo updated',
            'categories' => ['unknown_category'],
            'tags' => []
        ]);
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\UnprocessableEntityHttpException
     */
    public function testUpsertInvalidCodeFail()
    {
        $api = $this->createClient()->getAssetApi();
        $api->upsert('invalid code !', [
            'localized' => false,
            'description' => 'Invalid code',
            'end_of_use' => '2042-11-21',
            'tags' => [],
            'categories' => ['asset_main_catalog'],
            'variation_files' => [],
            'reference_files' => [],
        ]);
    }
}
