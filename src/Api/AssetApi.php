<?php

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\Pim\ApiClient\Exception\InvalidArgumentException;
use Akeneo\Pim\ApiClient\Pagination\PageFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorFactoryInterface;

/**
 * API implementation to manage assets.
 *
 * @author    Laurent Petard <laurent.petard@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class AssetApi implements AssetApiInterface
{
    const ASSETS_URI = '/api/rest/v1/assets';
    const ASSET_URI = '/api/rest/v1/assets/%s';

    /** @var ResourceClientInterface */
    private $resourceClient;

    /** @var PageFactoryInterface */
    private $pageFactory;

    /** @var ResourceCursorFactoryInterface */
    private $cursorFactory;

    public function __construct(
        ResourceClientInterface $resourceClient,
        PageFactoryInterface $pageFactory,
        ResourceCursorFactoryInterface $cursorFactory
    ) {
        $this->resourceClient = $resourceClient;
        $this->pageFactory = $pageFactory;
        $this->cursorFactory = $cursorFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function get($code)
    {
        return $this->resourceClient->getResource(static::ASSET_URI, [$code]);
    }

    /**
     * {@inheritdoc}
     */
    public function all($pageSize = 10, array $queryParameters = [])
    {
        $queryParameters['pagination_type'] = 'search_after';

        $firstPage = $this->listPerPage($pageSize, false, $queryParameters);

        return $this->cursorFactory->createCursor($pageSize, $firstPage);
    }

    /**
     * {@inheritdoc}
     */
    public function listPerPage($limit = 10, $withCount = false, array $queryParameters = [])
    {
        $data = $this->resourceClient->getResources(
            static::ASSETS_URI,
            [],
            $limit,
            $withCount,
            $queryParameters
        );
        return $this->pageFactory->createPage($data);
    }

    /**
     * {@inheritdoc}
     */
    public function create($code, array $data = [])
    {
        if (array_key_exists('code', $data)) {
            throw new InvalidArgumentException('The parameter "code" should not be defined in the data parameter');
        }

        $data['code'] = $code;

        return $this->resourceClient->createResource(static::ASSETS_URI, [], $data);
    }

    /**
     * {@inheritdoc}
     */
    public function upsert($code, array $data = [])
    {
        return $this->resourceClient->upsertResource(static::ASSET_URI, [$code], $data);
    }
}
