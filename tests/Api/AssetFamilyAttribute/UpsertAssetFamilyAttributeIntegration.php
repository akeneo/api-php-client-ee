<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\tests\Api\AssetFamilyAttribute;

use Akeneo\PimEnterprise\ApiClient\Api\AssetFamilyAttributeApi;
use Akeneo\PimEnterprise\ApiClient\tests\Api\ApiTestCaseEnterprise;
use donatj\MockWebServer\RequestInfo;
use donatj\MockWebServer\Response;
use donatj\MockWebServer\ResponseStack;
use PHPUnit\Framework\Assert;

class UpsertAssetFamilyAttributeIntegration extends ApiTestCaseEnterprise
{
    public function test_upsert_asset_family_attribute()
    {
        $this->server->setResponseOfPath(
            '/'. sprintf(AssetFamilyAttributeApi::ASSET_FAMILY_ATTRIBUTE_URI, 'packshot', 'media_preview'),
            new ResponseStack(
                new Response('', [], 204)
            )
        );

        $assetFamilyAttribute = [
            'code' => 'media_preview',
            'labels' => [
                'en_US' => 'Media Preview'
            ],
            'type' => 'media_link',
            "value_per_locale" => false,
            "value_per_channel" => false,
            "is_required_for_completeness" => false,
            "prefix" => "dam.com/my_assets/",
            "suffix" => null,
            "media_type" => "image"
        ];

        $api = $this->createClient()->getAssetFamilyAttributeApi();
        $response = $api->upsert('packshot', 'media_preview', $assetFamilyAttribute);

        Assert::assertSame($this->server->getLastRequest()->jsonSerialize()[RequestInfo::JSON_KEY_INPUT], json_encode($assetFamilyAttribute));
        Assert::assertSame(204, $response);
    }
}
