<?php

declare(strict_types=1);

namespace spec\Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityRecordApi;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityRecordApiInterface;
use PhpSpec\ObjectBehavior;

class ReferenceEntityRecordApiSpec extends ObjectBehavior
{
    function let(ResourceClientInterface $resourceClient)
    {
        $this->beConstructedWith($resourceClient);
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
}
