<?php

namespace spec\Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityMediaFileApi;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityMediaFileApiInterface;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\StreamInterface;

class ReferenceEntityMediaFileApiSpec extends ObjectBehavior
{
    function let(ResourceClientInterface $resourceClient)
    {
        $this->beConstructedWith($resourceClient);
    }

    function it_is_a_reference_entity_media_file_api()
    {
        $this->shouldImplement(ReferenceEntityMediaFileApiInterface::class);
    }

    function it_downloads_a_reference_entity_media_file(ResourceClientInterface $resourceClient, StreamInterface $streamBody)
    {
        $resourceClient
            ->getStreamedResource(ReferenceEntityMediaFileApi::MEDIA_FILE_DOWNLOAD_URI, ['images/starck.jpg'])
            ->willReturn($streamBody);

        $this->download('images/starck.jpg')->shouldReturn($streamBody);
    }
}
