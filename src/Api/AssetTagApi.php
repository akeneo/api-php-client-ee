<?php

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;

/**
 * API implementation to manage asset tags.
 *
 * @author    Laurent Petard <laurent.petard@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class AssetTagApi implements AssetTagApiInterface
{
    const ASSET_TAGS_URI = '/api/rest/v1/asset-tags';
    const ASSET_TAG_URI = '/api/rest/v1/asset-tags/%s';

    /** @var ResourceClientInterface */
    private $resourceClient;

    public function __construct(ResourceClientInterface $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }

    /**
     * {@inheritdoc}
     */
    public function get($code)
    {
        return $this->resourceClient->getResource(static::ASSET_TAG_URI, [$code]);
    }

    /**
     * {@inheritdoc}
     */
    public function upsert($code, array $data = [])
    {
        return $this->resourceClient->upsertResource(static::ASSET_TAG_URI, [$code], $data);
    }
}
