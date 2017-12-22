<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\v2_1\Api\AssetReferenceFile;

use Akeneo\Pim\ApiClient\tests\MediaSanitizer;
use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class UploadAssetReferenceFileIntegration extends ApiTestCase
{
    public function testUploadForLocalizableAsset()
    {
        $filePath = realpath(__DIR__ . '/../../../fixtures/ziggy.png');
        $baseUri = $this->getConfiguration()['pim']['base_uri'];

        $api = $this->createClient()->getAssetReferenceFileApi();
        $responseCode = $api->uploadForLocalizableAsset($filePath, 'ziggy', 'en_US');

        $this->assertSame(201, $responseCode);

        $assetReferenceFile = $api->getFromLocalizableAsset('ziggy', 'en_US');
        $expectedAssetReferenceFile = [
            'code'   => '5/c/8/3/5c835e7785cb174d8e7e39d7ee63be559f233be0_ziggy.jpg',
            'locale' => 'en_US',
            '_link'  => [
                'download' => [
                    'href' => $baseUri . '/api/rest/v1/assets/ziggy/reference-files/en_US/download'
                ]
            ],
        ];

        $this->assertSameContent($this->sanitizeAssetReferenceFile($expectedAssetReferenceFile), $this->sanitizeAssetReferenceFile($assetReferenceFile));
    }

    public function testUploadForNotLocalizableAsset()
    {
        $filePath = realpath(__DIR__ . '/../../../fixtures/ziggy-certification.jpg');
        $baseUri = $this->getConfiguration()['pim']['base_uri'];

        $api = $this->createClient()->getAssetReferenceFileApi();
        $responseCode = $api->uploadForNotLocalizableAsset($filePath, 'ziggy_certif');

        $this->assertSame(201, $responseCode);

        $assetReferenceFile = $api->getFromNotLocalizableAsset('ziggy_certif');
        $expectedAssetReferenceFile = [
            'code'   => '5/c/8/3/5c835e7785cb174d8e7e39d7ee63be559f233be0_ziggy_certification.jpg',
            'locale' => null,
            '_link'  => [
                'download' => [
                    'href' => $baseUri . '/api/rest/v1/assets/ziggy_certif/reference-files/no-locale/download'
                ]
            ],
        ];

        $this->assertSameContent($this->sanitizeAssetReferenceFile($expectedAssetReferenceFile), $this->sanitizeAssetReferenceFile($assetReferenceFile));
    }

    public function testUploadFromResourceFile()
    {
        $file = fopen(realpath(__DIR__ . '/../../../fixtures/ziggy.png'), 'rb');
        $baseUri = $this->getConfiguration()['pim']['base_uri'];

        $api = $this->createClient()->getAssetReferenceFileApi();
        $responseCode = $api->uploadForLocalizableAsset($file, 'ziggy', 'en_US');

        $this->assertSame(201, $responseCode);

        $assetReferenceFile = $api->getFromLocalizableAsset('ziggy', 'en_US');
        $expectedAssetReferenceFile = [
            'code'   => '5/c/8/3/5c835e7785cb174d8e7e39d7ee63be559f233be0_ziggy.jpg',
            'locale' => 'en_US',
            '_link'  => [
                'download' => [
                    'href' => $baseUri . '/api/rest/v1/assets/ziggy/reference-files/en_US/download'
                ]
            ],
        ];

        $this->assertSameContent($this->sanitizeAssetReferenceFile($expectedAssetReferenceFile), $this->sanitizeAssetReferenceFile($assetReferenceFile));
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\NotFoundHttpException
     */
    public function testUploadForAnUnknownAsset()
    {
        $filePath = realpath(__DIR__ . '/../../../fixtures/ziggy.png');
        $api = $this->createClient()->getAssetReferenceFileApi();

        $api->uploadForLocalizableAsset($filePath, 'unknown_asset', 'en_US');
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\UnprocessableEntityHttpException
     */
    public function testUploadForAnAssetThatShouldBeLocalizable()
    {
        $filePath = realpath(__DIR__ . '/../../../fixtures/ziggy.png');

        $api = $this->createClient()->getAssetReferenceFileApi();

        $api->uploadForNotLocalizableAsset($filePath, 'ziggy');
    }

    /**
     * @param array $assetReferenceFile
     *
     * @return array
     */
    protected function sanitizeAssetReferenceFile(array $assetReferenceFile)
    {
        $assetReferenceFile['code'] = MediaSanitizer::sanitize($assetReferenceFile['code']);

        return $assetReferenceFile;
    }
}
