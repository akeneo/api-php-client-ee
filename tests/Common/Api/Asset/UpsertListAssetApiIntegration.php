<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\Common\Api\Asset;

use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class UpsertListAssetApiIntegration extends ApiTestCase
{
    public function testUpsertListSuccessful()
    {
        $api = $this->createClient()->getAssetApi();
        $response  = $api->upsertList([
            [
                'code' => 'akeneo_logo',
                'description' => 'Akeneo logo updated',
            ],
            [
                'code' => 'unicorn',
                'description' => 'Unicorn asset',
                'localizable' => false,
                'end_of_use' => null
            ]
        ]);

        $this->assertInstanceOf('\Iterator', $response);
        $responseLines = iterator_to_array($response);
        $this->assertCount(2, $responseLines);

        $this->assertSame([
            'line'        => 1,
            'code'        => 'akeneo_logo',
            'status_code' => 204,
        ], $responseLines[1]);

        $this->assertSame([
            'line'        => 2,
            'code'        => 'unicorn',
            'status_code' => 201,
        ], $responseLines[2]);
    }

    public function testUpsertListFailed()
    {
        $api = $this->createClient()->getAssetApi();

        $response  = $api->upsertList([
            [
                'description' => 'Upsert without code',
                'categories' => [],
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
