<?php

namespace spec\Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Api\Operation\GettableResourceInterface;
use Akeneo\Pim\ApiClient\Api\Operation\ListableResourceInterface;
use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\Pim\ApiClient\Pagination\PageInterface;
use Akeneo\Pim\ApiClient\Pagination\PageFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;
use Akeneo\PimEnterprise\ApiClient\Api\PublishedProductModelApi;
use Akeneo\PimEnterprise\ApiClient\Api\PublishedProductModelApiInterface;
use PhpSpec\ObjectBehavior;

class PublishedProductModelApiSpec extends ObjectBehavior
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
        $this->shouldHaveType(PublishedProductModelApi::class);
        $this->shouldImplement(PublishedProductModelApiInterface::class);
        $this->shouldImplement(GettableResourceInterface::class);
        $this->shouldImplement(ListableResourceInterface::class);
    }

    function it_returns_a_published_product_model($resourceClient)
    {
        $publishedProductModelCode = 'a_product_model';
        $publishedProductModel = [
            'identifier' => 'a_product_model',
            'family_variant' => 'tshirts',
            'categories' => [
                'bar',
            ],
        ];

        $resourceClient
            ->getResource(PublishedProductModelApi::PUBLISHED_PRODUCT_MODEL_URI, [$publishedProductModelCode])
            ->willReturn($publishedProductModel);

        $this->get($publishedProductModelCode)->shouldReturn($publishedProductModel);
    }

    function it_returns_a_list_of_published_product_models_with_default_parameters(
        $resourceClient,
        $pageFactory,
        PageInterface $page
    ) {
        $resourceClient
            ->getResources(PublishedProductModelApi::PUBLISHED_PRODUCT_MODELS_URI, [], 10, false, [])
            ->willReturn([]);

        $pageFactory->createPage([])->willReturn($page);

        $this->listPerPage()->shouldReturn($page);
    }

    function it_returns_a_list_of_published_product_models_with_limit_and_count(
        $resourceClient,
        $pageFactory,
        PageInterface $page
    ) {
        $resourceClient
            ->getResources(PublishedProductModelApi::PUBLISHED_PRODUCT_MODELS_URI, [], 10, true, [])
            ->willReturn([]);

        $pageFactory->createPage([])->willReturn($page);

        $this->listPerPage(10, true)->shouldReturn($page);
    }

    function it_returns_a_cursor_on_the_list_of_published_product_models(
        $resourceClient,
        $pageFactory,
        $cursorFactory,
        PageInterface $page,
        ResourceCursorInterface $cursor
    ) {
        $resourceClient
            ->getResources(
                PublishedProductModelApi::PUBLISHED_PRODUCT_MODELS_URI,
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

    function it_returns_a_list_of_published_product_models_with_additional_query_parameters(
        $resourceClient,
        $pageFactory,
        PageInterface $page
    ) {
        $resourceClient
            ->getResources(PublishedProductModelApi::PUBLISHED_PRODUCT_MODELS_URI, [], null, null, ['foo' => 'bar'])
            ->willReturn([]);

        $pageFactory->createPage([])->willReturn($page);

        $this->listPerPage(null, null, ['foo' => 'bar'])->shouldReturn($page);
    }
}
