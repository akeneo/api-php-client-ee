<?php

namespace spec\Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityAttributeOptionApi;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityAttributeOptionApiInterface;
use PhpSpec\ObjectBehavior;

class ReferenceEntityAttributeOptionApiSpec extends ObjectBehavior
{
    function let(ResourceClientInterface $resourceClient)
    {
        $this->beConstructedWith($resourceClient);
    }

    function it_is_a_reference_entity_attribute_api()
    {
        $this->shouldImplement(ReferenceEntityAttributeOptionApiInterface::class);
    }

    function it_returns_a_reference_entity_attribute_option(ResourceClientInterface $resourceClient)
    {
        $option = [
            'code'   => 'red',
            'labels' => [
                'en_US' => 'Red',
                'fr_FR' => 'Rouge',
            ],
        ];

        $resourceClient
            ->getResource(ReferenceEntityAttributeOptionApi::REFERENCE_ENTITY_ATTRIBUTE_OPTION_URI, [
                'designer', 'favorite_color', 'red'
            ])
            ->willReturn($option);

        $this->get('designer', 'favorite_color', 'red')->shouldReturn($option);
    }

    function it_returns_the_list_of_attribute_options_of_a_reference_entity_attribute(ResourceClientInterface $resourceClient)
    {
        $options = [
            [
                'code'   => 'red',
                'labels' => [
                    'en_US' => 'Red',
                    'fr_FR' => 'Rouge',
                ],
            ],
            [
                'code'   => 'blue',
                'labels' => [
                    'en_US' => 'Blue',
                    'fr_FR' => 'Bleu',
                ],
            ]
        ];

        $resourceClient
            ->getResource(ReferenceEntityAttributeOptionApi::REFERENCE_ENTITY_ATTRIBUTE_OPTIONS_URI, [
                'designer', 'favorite_color'
            ])
            ->willReturn($options);

        $this->all('designer', 'favorite_color')->shouldReturn($options);
    }
}
