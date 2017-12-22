<?php

namespace spec\Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\Pim\ApiClient\FileSystem\FileSystemInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetReferenceFileApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetReferenceFileApiInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;

class AssetReferenceFileApiSpec extends ObjectBehavior
{
    public function let(ResourceClientInterface $resourceClient, FileSystemInterface $fileSystem)
    {
        $this->beConstructedWith($resourceClient, $fileSystem);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AssetReferenceFileApi::class);
        $this->shouldImplement(AssetReferenceFileApiInterface::class);
    }

    function it_gets_a_localizable_asset_reference_file($resourceClient)
    {
        $assetReferenceFile = [
            'code'   => '5/c/8/3/5c835e7785cb174d8e7e39d7ee63be559f233be0_Ziggy.jpg',
            'locale' => 'en_US',
            '_link'  => [
                'download' => [
                    'href' => 'http://akeneo-ped-master.local/api/rest/v1/assets/ziggy/reference-files/en_US/download'
                ]
            ],
        ];

        $resourceClient
            ->getResource(AssetReferenceFileApi::ASSET_REFERENCE_FILE_URI, ['ziggy', 'en_US'])
            ->willReturn($assetReferenceFile);

        $this->getFromLocalizableAsset('ziggy', 'en_US')->shouldReturn($assetReferenceFile);
    }

    function it_gets_a_not_localizable_asset_reference_file($resourceClient)
    {
        $assetReferenceFile = [
            'code'   => '5/c/8/3/5c835e7785cb174d8e7e39d7ee63be559f233be0_Ziggy.jpg',
            'locale' => 'en_US',
            '_link'  => [
                'download' => [
                    'href' => 'http://akeneo-ped-master.local/api/rest/v1/assets/ziggy/reference-files/no-locale/download'
                ]
            ],
        ];

        $resourceClient
            ->getResource(AssetReferenceFileApi::ASSET_REFERENCE_FILE_URI, ['ziggy', 'no-locale'])
            ->willReturn($assetReferenceFile);

        $this->getFromNotLocalizableAsset('ziggy')->shouldReturn($assetReferenceFile);
    }

    function it_uploads_a_localizable_asset_reference_file($resourceClient, $fileSystem, ResponseInterface $response)
    {
        $fileSystem->getResourceFromPath('images/ziggy.png')->willReturn('fileResource');

        $requestParts = [[
            'name' => 'file',
            'contents' => 'fileResource',
        ]];

        $response->getStatusCode()->willReturn(201);

        $resourceClient
            ->createMultipartResource(AssetReferenceFileApi::ASSET_REFERENCE_FILE_URI, ['ziggy', 'en_US'], $requestParts)
            ->willReturn($response);

        $this->uploadForLocalizableAsset('images/ziggy.png', 'ziggy', 'en_US')->shouldReturn(201);
    }

    function it_uploads_a_not_localizable_asset_reference_file($resourceClient, $fileSystem, ResponseInterface $response)
    {
        $fileSystem->getResourceFromPath('images/ziggy.png')->willReturn('fileResource');

        $requestParts = [[
            'name' => 'file',
            'contents' => 'fileResource',
        ]];

        $response->getStatusCode()->willReturn(201);

        $resourceClient
            ->createMultipartResource(AssetReferenceFileApi::ASSET_REFERENCE_FILE_URI, ['ziggy', 'en_US'], $requestParts)
            ->willReturn($response);

        $this->uploadForLocalizableAsset('images/ziggy.png', 'ziggy', 'en_US')->shouldReturn(201);
    }

    function it_uploads_an_asset_reference_file_from_a_file_resource($resourceClient, $fileSystem, ResponseInterface $response)
    {
        $fileSystem->getResourceFromPath(Argument::any())->shouldNotBeCalled();

        $fileResource = fopen('php://stdin', 'r');

        $requestParts = [[
            'name' => 'file',
            'contents' => $fileResource,
        ]];

        $response->getStatusCode()->willReturn(201);

        $resourceClient
            ->createMultipartResource(AssetReferenceFileApi::ASSET_REFERENCE_FILE_URI, ['ziggy', 'en_US'], $requestParts)
            ->willReturn($response);

        $this->uploadForLocalizableAsset($fileResource, 'ziggy', 'en_US')->shouldReturn(201);
    }
}
