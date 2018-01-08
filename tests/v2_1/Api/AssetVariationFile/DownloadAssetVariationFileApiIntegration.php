<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\v2_1\Api\AssetVariationFile;

use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;
use Psr\Http\Message\StreamInterface;

class DownloadAssetVariationFileApiIntegration extends ApiTestCase
{
    public function testDownloadALocalizableAssetVariationFile()
    {
        $expectedFilePath = realpath(__DIR__ . '/../../../fixtures/ziggy.png');

        $api = $this->createClient()->getAssetVariationFileApi();
        $api->uploadForLocalizableAsset($expectedFilePath, 'ziggy', 'ecommerce', 'en_US');

        $downloadResponse = $api->downloadFromLocalizableAsset('ziggy', 'ecommerce', 'en_US');

        $this->assertInstanceOf(StreamInterface::class, $downloadResponse);
        $this->assertSame(file_get_contents($expectedFilePath), $downloadResponse->getContents());
    }

    public function testDownloadANotLocalizableAssetVariationFile()
    {
        $expectedFilePath = realpath(__DIR__ . '/../../../fixtures/ziggy-certification.jpg');

        $api = $this->createClient()->getAssetVariationFileApi();
        $api->uploadForNotLocalizableAsset($expectedFilePath, 'ziggy_certif', 'ecommerce');

        $downloadResponse = $api->downloadFromNotLocalizableAsset('ziggy_certif', 'ecommerce');

        $this->assertInstanceOf(StreamInterface::class, $downloadResponse);
        $this->assertSame(file_get_contents($expectedFilePath), $downloadResponse->getContents());
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\NotFoundHttpException
     */
    public function testDownloadFromLocalizableAssetNotFound()
    {
        $api = $this->createClient()->getAssetVariationFileApi();

        $api->downloadFromLocalizableAsset('ziggy', 'mobile', 'en_US');
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\NotFoundHttpException
     */
    public function testDownloadFromNotLocalizableAssetNotFound()
    {
        $api = $this->createClient()->getAssetVariationFileApi();

        $api->downloadFromNotLocalizableAsset('ziggy_certif', 'ecommerce');
    }
}
