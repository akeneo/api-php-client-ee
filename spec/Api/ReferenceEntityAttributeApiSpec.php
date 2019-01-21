<?php

declare(strict_types=1);

namespace spec\Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityAttributeApi;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityAttributeApiInterface;
use PhpSpec\ObjectBehavior;

class ReferenceEntityAttributeApiSpec extends ObjectBehavior
{
    function let(ResourceClientInterface $resourceClient)
    {
        $this->beConstructedWith($resourceClient);
    }

    function it_is_a_reference_entity_attribute_api()
    {
        $this->shouldImplement(ReferenceEntityAttributeApiInterface::class);
    }

    function it_returns_a_reference_entity_attribute(ResourceClientInterface $resourceClient)
    {
        $attribute = [
            'code'                         => 'description',
            'labels'                       => [
                'en_US' => 'Description',
                'fr_FR' => 'Description',
            ],
            'type'                         => 'text',
            'localizable'                  => true,
            'scopable'                     => false,
            'is_required_for_completeness' => true,
            'max_characters'               => null,
            'is_textarea'                  => true,
            'is_rich_text_editor'          => true,
            'validation_rule'              => null,
            'validation_regexp'            => null,
        ];

        $resourceClient
            ->getResource(ReferenceEntityAttributeApi::REFERENCE_ENTITY_ATTRIBUTE_URI, ['designer', 'description'])
            ->willReturn($attribute);

        $this->get('designer', 'description')->shouldReturn($attribute);
    }
}
