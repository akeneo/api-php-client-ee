<?php

namespace Akeneo\PimEnterprise\ApiClient\Search;

use Akeneo\Pim\ApiClient\Api\ProductApiInterface;
use Akeneo\Pim\ApiClient\Exception\InvalidArgumentException;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;
use Akeneo\Pim\ApiClient\Search\SearchBuilder;
use Akeneo\PimEnterprise\ApiClient\Api\CatalogApiInterface;

class SharedCatalogBuilder implements SharedCatalogBuilderInterface
{
    private $catalogApi;
    private $productApi;

    public function __construct(CatalogApiInterface $catalogApi, ProductApiInterface $productApi)
    {
        $this->catalogApi = $catalogApi;
        $this->productApi = $productApi;
    }

    public function search($catalogCode): ResourceCursorInterface
    {
        $catalog = $this->catalogApi->get($catalogCode);
        $filters = $this->buildFilter($catalog);

        return $this->productApi->all(50, [
            'search' => $filters,
            'scope' => $catalog['structure']['scope'],
            'locales' => implode(',', $catalog['structure']['locales']),
        ]);
    }

    private function buildFilter($catalog)
    {
        $searchBuilder = new SearchBuilder();
        foreach ($catalog['filters'] as $filter) {
            $searchBuilder->addFilter($filter['field'], $filter['operator'], $filter['value']);
        }

        return $searchBuilder;
    }

    private function getCatalog($catalogCode)
    {
        $catalogs = $this->catalogApi->all();
        foreach ($catalogs as $catalog) {
            if ($catalog['code'] === $catalogCode) {
                return $catalog;
            }
        }

        throw new InvalidArgumentException("Catalog not found");
    }
}
