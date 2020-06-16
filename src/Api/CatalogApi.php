<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;

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

        throw new \Exception('Catalog "' . $code . '" does not exist.');
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
