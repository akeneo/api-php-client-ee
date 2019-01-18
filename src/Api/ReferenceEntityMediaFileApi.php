<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Api\Operation\HttpException;
use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;

/**
 * @author    Laurent Petard <laurent.petard@akeneo.com>
 * @copyright 2018 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ReferenceEntityMediaFileApi implements ReferenceEntityMediaFileApiInterface
{
    const MEDIA_FILE_DOWNLOAD_URI = 'api/rest/v1/reference-entities-media-files/%s';

    /** @var ResourceClientInterface */
    private $resourceClient;

    public function __construct(ResourceClientInterface $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }

    /**
     * {@inheritdoc}
     */
    public function download($code)
    {
        return $this->resourceClient->getStreamedResource(static::MEDIA_FILE_DOWNLOAD_URI, [$code]);
    }
}
