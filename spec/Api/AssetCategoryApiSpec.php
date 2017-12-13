<?php

namespace spec\Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Api\Operation\GettableResourceInterface;
use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetCategoryApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetCategoryApiInterface;
use PhpSpec\ObjectBehavior;

class AssetCategoryApiSpec extends ObjectBehavior
{
    public function let(ResourceClientInterface $resourceClient)
    {
        $this->beConstructedWith($resourceClient);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AssetCategoryApi::class);
        $this->shouldImplement(AssetCategoryApiInterface::class);
        $this->shouldImplement(GettableResourceInterface::class);
    }

    public function it_gets_an_asset_category($resourceClient)
    {
        $assetCategory = [
            'code' => 'asset_main_catalog',
            'parent' => null,
            'labels' => [
                'en_US' => 'dolor sed perferendis',
            ],
        ];

        $resourceClient->getResource(AssetCategoryApi::ASSET_CATEGORY_URI, ['asset_main_catalog'])->willReturn($assetCategory);

        $this->get('asset_main_catalog')->shouldReturn($assetCategory);
    }
}
