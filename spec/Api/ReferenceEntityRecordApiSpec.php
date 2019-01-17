<?php

declare(strict_types=1);

namespace spec\Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\Pim\ApiClient\Pagination\PageFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\PageInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityRecordApi;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityRecordApiInterface;
use PhpSpec\ObjectBehavior;

class ReferenceEntityRecordApiSpec extends ObjectBehavior
{
    function let(
        ResourceClientInterface $resourceClient,
        PageFactoryInterface $pageFactory,
        ResourceCursorFactoryInterface $cursorFactory
    ) {
        $this->beConstructedWith($resourceClient, $pageFactory, $cursorFactory);
    }

    function it_is_a_reference_entity_record_api()
    {
        $this->shouldImplement(ReferenceEntityRecordApiInterface::class);
    }

    function it_returns_a_reference_entity_record(ResourceClientInterface $resourceClient)
    {
        $record = [
            'code' => 'starck',
            'values' => [
                'label' => [
                    [
                        'channel' => null,
                        'locale'  => 'en_US',
                        'data'    => 'Philippe Starck'
                    ],
                ]
            ]
        ];

        $resourceClient
            ->getResource(ReferenceEntityRecordApi::REFERENCE_ENTITY_RECORD_URI, ['designer', 'starck'])
            ->willReturn($record);

        $this->get('designer', 'starck')->shouldReturn($record);
    }

    function it_returns_a_cursor_to_list_all_the_records_of_reference_entity(
        ResourceClientInterface $resourceClient,
        PageFactoryInterface $pageFactory,
        ResourceCursorFactoryInterface $cursorFactory,
        PageInterface $page,
        ResourceCursorInterface $cursor
    ) {
        $resourceClient
            ->getResources(ReferenceEntityRecordApi::REFERENCE_ENTITY_RECORDS_URI, ['designer'], null, false, [])
            ->willReturn([]);

        $pageFactory->createPage([])->willReturn($page);
        $cursorFactory->createCursor(null, $page)->willReturn($cursor);

        $this->all('designer', [])->shouldReturn($cursor);
    }
}
