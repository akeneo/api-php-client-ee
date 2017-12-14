<?php

namespace spec\Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetTagApi;
use PhpSpec\ObjectBehavior;

class AssetTagApiSpec extends ObjectBehavior
{
    public function let(ResourceClientInterface $resourceClient)
    {
        $this->beConstructedWith($resourceClient);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Akeneo\PimEnterprise\ApiClient\Api\AssetTagApi');
    }

    public function it_gets_an_asset_tag($resourceClient)
    {
        $assetTag = ['code' => 'logo'];

        $resourceClient->getResource(AssetTagApi::ASSET_TAG_URI, ['logo'])->willReturn($assetTag);

        $this->get('logo')->shouldReturn($assetTag);
    }

    public function it_upserts_an_asset_tag($resourceClient)
    {
        $resourceClient
            ->upsertResource(AssetTagApi::ASSET_TAG_URI, ['logo'], [])
            ->willReturn(201);

        $this->upsert('logo')->shouldReturn(201);
    }
}
