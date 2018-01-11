<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\v2_1\Api\AssetReferenceFile;

use Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ApiTestCase;
use Psr\Http\Message\StreamInterface;

class DownloadAssetReferenceFileIntegration extends ApiTestCase
{
    public function testDownloadALocalizableAssetReferenceFile()
    {
        $expectedFilePath = realpath(__DIR__ . '/../../../fixtures/ziggy.png');

        $api = $this->createClient()->getAssetReferenceFileApi();
        $api->uploadForLocalizableAsset($expectedFilePath, 'ziggy', 'en_US');

        $downloadResponse = $api->downloadFromLocalizableAsset('ziggy', 'en_US');

        $this->assertInstanceOf(StreamInterface::class, $downloadResponse);
        $this->assertSame(file_get_contents($expectedFilePath), $downloadResponse->getContents());
    }

    public function testDownloadANotLocalizableAssetReferenceFile()
    {
        $expectedFilePath = realpath(__DIR__ . '/../../../fixtures/ziggy-certification.jpg');

        $api = $this->createClient()->getAssetReferenceFileApi();
        $api->uploadForNotLocalizableAsset($expectedFilePath, 'ziggy_certif');

        $downloadResponse = $api->downloadFromNotLocalizableAsset('ziggy_certif');

        $this->assertInstanceOf(StreamInterface::class, $downloadResponse);
        $this->assertSame(file_get_contents($expectedFilePath), $downloadResponse->getContents());
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\NotFoundHttpException
     */
    public function testDownloadFromLocalizableAssetNotFound()
    {
        $api = $this->createClient()->getAssetReferenceFileApi();

        $api->downloadFromLocalizableAsset('ziggy', 'en_US');
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\NotFoundHttpException
     */
    public function testDownloadFromNotLocalizableAssetNotFound()
    {
        $api = $this->createClient()->getAssetReferenceFileApi();

        $api->downloadFromNotLocalizableAsset('ziggy_certif');
    }
}
