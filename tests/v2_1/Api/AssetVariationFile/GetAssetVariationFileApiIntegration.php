<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\v2_1\Api\AssetVariationFile;

use Akeneo\Pim\ApiClient\tests\MediaSanitizer;
use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;

class GetAssetVariationFileApiIntegration extends ApiTestCase
{
    public function testGetFromLocalizableAsset()
    {
        $filePath = realpath(__DIR__ . '/../../../fixtures/ziggy.png');
        $baseUri = $this->getConfiguration()['pim']['base_uri'];

        $api = $this->createClient()->getAssetVariationFileApi();
        $api->uploadForLocalizableAsset($filePath, 'ziggy', 'ecommerce', 'en_US');

        $assetVariationFile = $api->getFromLocalizableAsset('ziggy', 'ecommerce', 'en_US');

        $expectedAssetVariationFile = [
            'code'   => '5/c/8/3/5c835e7785cb174d8e7e39d7ee63be559f233be0_ziggy_ecommerce.jpg',
            'scope'  => 'ecommerce',
            'locale' => 'en_US',
            '_link'  => [
                'download' => [
                    'href' => $baseUri . '/api/rest/v1/assets/ziggy/variation-files/ecommerce/en_US/download'
                ]
            ],
        ];

        $this->assertSameContent($this->sanitizeAssetVariationFile($expectedAssetVariationFile), $this->sanitizeAssetVariationFile($assetVariationFile));
    }

    public function testGetFromNotLocalizableAsset()
    {
        $filePath = realpath(__DIR__ . '/../../../fixtures/ziggy-certification.jpg');
        $baseUri = $this->getConfiguration()['pim']['base_uri'];

        $api = $this->createClient()->getAssetVariationFileApi();
        $api->uploadForNotLocalizableAsset($filePath, 'ziggy_certif', 'ecommerce');

        $assetVariationFile = $api->getFromNotLocalizableAsset('ziggy_certif', 'ecommerce');

        $expectedAssetVariationFile = [
            'code'   => '2/9/b/f/29bfa18ced500c5fca2072dab978737576ca47ca_ziggy_certification_ecommerce.jpg',
            'scope'  => 'ecommerce',
            'locale' => null,
            '_link'  => [
                'download' => [
                    'href' => $baseUri . '/api/rest/v1/assets/ziggy_certif/variation-files/ecommerce/no-locale/download'
                ]
            ],
        ];

        $this->assertSameContent($this->sanitizeAssetVariationFile($expectedAssetVariationFile), $this->sanitizeAssetVariationFile($assetVariationFile));
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\NotFoundHttpException
     */
    public function testGetFromLocalizableAssetNotFound()
    {
        $api = $this->createClient()->getAssetVariationFileApi();

        $api->getFromLocalizableAsset('ziggy', 'mobile', 'en_US');
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\NotFoundHttpException
     */
    public function testGetFromNotLocalizableAssetNotFound()
    {
        $api = $this->createClient()->getAssetVariationFileApi();

        $api->getFromNotLocalizableAsset('ziggy_certif', 'mobile');
    }

    /**
     * @param array $assetVariationFile
     *
     * @return array
     */
    protected function sanitizeAssetVariationFile(array $assetVariationFile)
    {
        $assetVariationFile['code'] = MediaSanitizer::sanitize($assetVariationFile['code']);

        return $assetVariationFile;
    }
}
