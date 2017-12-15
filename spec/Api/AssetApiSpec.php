<?php

namespace spec\Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetApi;
use PhpSpec\ObjectBehavior;

class AssetApiSpec extends ObjectBehavior
{
    public function let(ResourceClientInterface $resourceClient)
    {
        $this->beConstructedWith($resourceClient);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(AssetApi::class);
    }

    public function it_gets_an_asset($resourceClient)
    {
        $asset = [
            'code' => 'akeneo_logo',
            'localized' => false,
            'description' => 'Akeneo logo',
            'end_of_use' => null,
            'tags' => [],
            'categories' => ['asset_main_catalog'],
            'variation_files' => [],
            'reference_files' => [],
        ];

        $resourceClient->getResource(AssetApi::ASSET_URI, ['akeneo_logo'])->willReturn($asset);

        $this->get('akeneo_logo')->shouldReturn($asset);
    }
}
