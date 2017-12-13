<?php

namespace spec\Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Api\Operation\GettableResourceInterface;
use Akeneo\Pim\ApiClient\Api\Operation\ListableResourceInterface;
use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\Pim\ApiClient\Pagination\PageFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\PageInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetCategoryApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetCategoryApiInterface;
use PhpSpec\ObjectBehavior;

class AssetCategoryApiSpec extends ObjectBehavior
{
    public function let(
        ResourceClientInterface $resourceClient,
        PageFactoryInterface $pageFactory,
        ResourceCursorFactoryInterface $cursorFactory
    ) {
        $this->beConstructedWith($resourceClient, $pageFactory, $cursorFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AssetCategoryApi::class);
        $this->shouldImplement(AssetCategoryApiInterface::class);
        $this->shouldImplement(GettableResourceInterface::class);
        $this->shouldImplement(ListableResourceInterface::class);
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

    function it_returns_a_list_of_asset_categories_with_default_parameters(
        $resourceClient,
        $pageFactory,
        PageInterface $page
    ) {
        $resourceClient
            ->getResources(AssetCategoryApi::ASSET_CATEGORIES_URI, [], 10, false, [])
            ->willReturn([]);

        $pageFactory->createPage([])->willReturn($page);

        $this->listPerPage()->shouldReturn($page);
    }

    function it_returns_a_list_of_asset_categories_with_limit_and_count(
        $resourceClient,
        $pageFactory,
        PageInterface $page
    ) {
        $resourceClient
            ->getResources(AssetCategoryApi::ASSET_CATEGORIES_URI, [], 10, true, [])
            ->willReturn([]);

        $pageFactory->createPage([])->willReturn($page);

        $this->listPerPage(10, true)->shouldReturn($page);
    }

    function it_returns_a_cursor_on_the_list_of_asset_categories(
        $resourceClient,
        $pageFactory,
        $cursorFactory,
        PageInterface $page,
        ResourceCursorInterface $cursor
    ) {
        $resourceClient
            ->getResources(
                AssetCategoryApi::ASSET_CATEGORIES_URI,
                [],
                10,
                false,
                []
            )
            ->willReturn([]);

        $pageFactory->createPage([])->willReturn($page);

        $cursorFactory->createCursor(10, $page)->willReturn($cursor);

        $this->all(10, [])->shouldReturn($cursor);
    }

    function it_returns_a_list_of_asset_categories_with_additional_query_parameters(
        $resourceClient,
        $pageFactory,
        PageInterface $page
    ) {
        $resourceClient
            ->getResources(AssetCategoryApi::ASSET_CATEGORIES_URI, [], null, null, ['foo' => 'bar'])
            ->willReturn([]);

        $pageFactory->createPage([])->willReturn($page);

        $this->listPerPage(null, null, ['foo' => 'bar'])->shouldReturn($page);
    }

    function it_upserts_an_asset_category($resourceClient)
    {
        $resourceClient
            ->upsertResource(AssetCategoryApi::ASSET_CATEGORY_URI, ['asset_main_catalog'], [
                'labels' => [
                    'en_US' => 'Nullam ullamcorper',
                ]
            ])
            ->willReturn(204);

        $this->upsert('asset_main_catalog', [
            'labels' => [
                'en_US' => 'Nullam ullamcorper',
            ]
        ])->shouldReturn(204);
    }
}
