<?php

declare(strict_types=1);

namespace spec\Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\Pim\ApiClient\Pagination\PageFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\PageInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityApi;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityApiInterface;
use PhpSpec\ObjectBehavior;

class ReferenceEntityApiSpec extends ObjectBehavior
{
    function let(
        ResourceClientInterface $resourceClient,
        PageFactoryInterface $pageFactory,
        ResourceCursorFactoryInterface $cursorFactory
    ) {
        $this->beConstructedWith($resourceClient, $pageFactory, $cursorFactory);
    }

    function it_is_a_reference_entity_api()
    {
        $this->shouldImplement(ReferenceEntityApiInterface::class);
    }

    function it_returns_a_reference_entity(ResourceClientInterface $resourceClient)
    {
        $referenceEntity = [
            'code' => 'designer',
            'labels' => [
                'en_US' => 'Designer'
            ]
        ];

        $resourceClient
            ->getResource(ReferenceEntityApi::REFERENCE_ENTITY_URI, ['designer'])
            ->willReturn($referenceEntity);

        $this->get('designer')->shouldReturn($referenceEntity);
    }

    function it_returns_a_cursor_to_list_all_the_reference_entities(
        ResourceClientInterface $resourceClient,
        PageFactoryInterface $pageFactory,
        ResourceCursorFactoryInterface $cursorFactory,
        PageInterface $page,
        ResourceCursorInterface $cursor
    ) {
        $resourceClient
            ->getResources(ReferenceEntityApi::REFERENCE_ENTITIES_URI, [], null, false, [])
            ->willReturn([]);

        $pageFactory->createPage([])->willReturn($page);
        $cursorFactory->createCursor(null, $page)->willReturn($cursor);

        $this->all()->shouldReturn($cursor);
    }

    function it_upserts_a_reference_entity(ResourceClientInterface $resourceClient)
    {
        $referenceEntityData = [
            'code' => 'designer',
            'labels' => [
                'en_US' => 'Designer'
            ]
        ];
        $resourceClient
            ->upsertResource(ReferenceEntityApi::REFERENCE_ENTITY_URI, ['designer'], $referenceEntityData)
            ->willReturn(204);

        $this->upsert('designer', $referenceEntityData)->shouldReturn(204);
    }

    function it_upserts_a_list_of_reference_entities(ResourceClientInterface $resourceClient)
    {
        $referenceEntities = [
            [
                'code' => 'brand',
                'labels' => [
                    'en_US' => 'Brand'
                ]
            ],
            [
                'code' => 'color',
                'labels' => [
                    'en_US' => 'Color'
                ]
            ]
        ];

        $responses = [
            [
                'code' => 'brand',
                'status_code' =>204
            ],
            [
                'code' => 'color',
                'status_code' =>201
            ],
        ];

        $resourceClient
            ->upsertJsonResourceList(ReferenceEntityApi::REFERENCE_ENTITIES_URI, [], $referenceEntities)
            ->willReturn($responses);

        $this->upsertList($referenceEntities)->shouldReturn($responses);
    }
}
