<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\Pim\ApiClient\Exception\InvalidArgumentException;
use Akeneo\Pim\ApiClient\Exception\NotFoundHttpException;
use Akeneo\Pim\ApiClient\Pagination\PageFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorFactoryInterface;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;

class CatalogApi implements CatalogApiInterface
{
    const CATALOG_URI = 'api/rest/v1/catalog';

    /** @var ResourceClientInterface */
    private $resourceClient;

    public function __construct(ResourceClientInterface $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }

    public function get($code): array
    {
        $catalogs = $this->all();
        foreach ($catalogs as $catalog) {
            if ($catalog['code'] === $code) {
                return $catalog;
            }
        }

        throw new NotFoundHttpException('Catalog "' . $code . '" does not exist.');
    }

    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->resourceClient->getResources(
            static::CATALOG_URI,
            [],
            null,
            false,
            []
        );
    }
}
