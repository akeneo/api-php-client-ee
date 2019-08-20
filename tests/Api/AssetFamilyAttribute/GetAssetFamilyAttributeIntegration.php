<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\tests\Api\AssetFamilyAttribute;

use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetFamilyAttributeApi;
use Akeneo\PimEnterprise\ApiClient\tests\Api\ApiTestCaseEnterprise;
use donatj\MockWebServer\RequestInfo;
use donatj\MockWebServer\Response;
use donatj\MockWebServer\ResponseStack;
use PHPUnit\Framework\Assert;

class GetAssetFamilyAttributeIntegration extends ApiTestCaseEnterprise
{
    public function test_get_asset_family_attribute()
    {
        $this->server->setResponseOfPath(
            '/'. sprintf(AssetFamilyAttributeApi::ASSET_FAMILY_ATTRIBUTE_URI, 'packshot', 'media_preview'),
            new ResponseStack(
                new Response($this->getPackshotPreviewAttribute(), [], 200)
            )
        );

        $api = $this->createClient()->getAssetFamilyAttributeApi();
        $familyAttribute = $api->get('packshot', 'media_preview');

        Assert::assertSame($this->server->getLastRequest()->jsonSerialize()[RequestInfo::JSON_KEY_METHOD], 'GET');
        Assert::assertEquals($familyAttribute, json_decode($this->getPackshotPreviewAttribute(), true));
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\NotFoundHttpException
     * @expectedExceptionMessage Resource `foo` does not exist.
     */
    public function test_get_unknown_asset_family_attribute()
    {
        $this->server->setResponseOfPath(
            '/'. sprintf(AssetFamilyAttributeApi::ASSET_FAMILY_ATTRIBUTE_URI, 'packshot', 'foo'),
            new ResponseStack(
                new Response('{"code": 404, "message":"Resource `foo` does not exist."}', [], 404)
            )
        );

        $api = $this->createClient()->getAssetFamilyAttributeApi();
        $api->get('packshot', 'foo');
    }

    private function getPackshotPreviewAttribute(): string
    {
        return <<<JSON
            {
                "code": "media_preview",
                "labels": {
                    "en_US": "Media preview",
                    "fr_FR": "Aperçu du média"
                },
                "type": "media_link",
                "value_per_locale": false,
                "value_per_channel": false,
                "is_required_for_completeness": false,
                "prefix": "dam.com/my_assets/",
                "suffix": null,
                "media_type": "image"
            }
JSON;
    }
}
