<?php

namespace spec\Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\Pim\ApiClient\Pagination\PageFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\PageInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetApi;
use PhpSpec\ObjectBehavior;

class AssetApiSpec extends ObjectBehavior
{
    function let(
        ResourceClientInterface $resourceClient,
        PageFactoryInterface $pageFactory,
        ResourceCursorFactoryInterface $cursorFactory
    ) {
        $this->beConstructedWith($resourceClient, $pageFactory, $cursorFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AssetApi::class);
    }

    function it_gets_an_asset($resourceClient)
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

    function it_returns_a_list_of_assets_with_default_parameters(
        $resourceClient,
        $pageFactory,
        PageInterface $page
    ) {
        $resourceClient
            ->getResources(AssetApi::ASSETS_URI, [], 10, false, [])
            ->willReturn([]);
        $pageFactory->createPage([])->willReturn($page);
        $this->listPerPage()->shouldReturn($page);
    }

    function it_returns_a_list_of_assets_with_limit_and_count(
        $resourceClient,
        $pageFactory,
        PageInterface $page
    ) {
        $resourceClient
            ->getResources(AssetApi::ASSETS_URI, [], 10, true, [])
            ->willReturn([]);
        $pageFactory->createPage([])->willReturn($page);
        $this->listPerPage(10, true)->shouldReturn($page);
    }

    function it_returns_a_cursor_on_the_list_of_assets(
        $resourceClient,
        $pageFactory,
        $cursorFactory,
        PageInterface $page,
        ResourceCursorInterface $cursor
    ) {
        $resourceClient
            ->getResources(
                AssetApi::ASSETS_URI,
                [],
                10,
                false,
                ['pagination_type' => 'search_after']
            )
            ->willReturn([]);
        $pageFactory->createPage([])->willReturn($page);
        $cursorFactory->createCursor(10, $page)->willReturn($cursor);
        $this->all(10, [])->shouldReturn($cursor);
    }

    function it_returns_a_list_of_assets_with_additional_query_parameters(
        $resourceClient,
        $pageFactory,
        PageInterface $page
    ) {
        $resourceClient
            ->getResources(AssetApi::ASSETS_URI, [], null, null, ['foo' => 'bar'])
            ->willReturn([]);
        $pageFactory->createPage([])->willReturn($page);
        $this->listPerPage(null, null, ['foo' => 'bar'])->shouldReturn($page);
    }
}
