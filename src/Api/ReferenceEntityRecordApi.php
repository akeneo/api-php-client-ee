<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;

/**
 * @author    Laurent Petard <laurent.petard@akeneo.com>
 * @copyright 2018 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ReferenceEntityRecordApi implements ReferenceEntityRecordApiInterface
{
    const REFERENCE_ENTITY_RECORD_URI = 'api/rest/v1/reference-entities/%s/records/%s';

    /** @var ResourceClientInterface */
    private $resourceClient;

    public function __construct(ResourceClientInterface $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $referenceEntityCode, string $recordCode): array
    {
        return $this->resourceClient->getResource(static::REFERENCE_ENTITY_RECORD_URI, [$referenceEntityCode, $recordCode]);
    }
}
