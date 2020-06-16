<?php

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Api\ProductApiInterface;
use Akeneo\Pim\ApiClient\Exception\InvalidArgumentException;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;
use Akeneo\Pim\ApiClient\Search\SearchBuilder;
use Akeneo\PimEnterprise\ApiClient\Api\CatalogApiInterface;

class SharedCatalogApi implements SharedCatalogApiInterface
{
    private $catalogApi;
    private $productApi;

    public function __construct(CatalogApiInterface $catalogApi, ProductApiInterface $productApi)
    {
        $this->catalogApi = $catalogApi;
        $this->productApi = $productApi;
    }

    public function search(string $catalogCode, int $pageSize = 50): ResourceCursorInterface
    {
        $catalog = $this->catalogApi->get($catalogCode);
        $filters = $this->buildFilter($catalog);

        $data = [
            'search' => $filters,
            'scope' => $catalog['structure']['scope'],
            'search_scope' => $catalog['structure']['scope'],
        ];

        if(!empty($catalog['structure']['locales'])) {
//            $data['locales'] = implode(',', $catalog['structure']['locales']);
        }

        if(!empty($catalog['structure']['attributes'])) {
            $data['attributes'] = implode(',', $catalog['structure']['attributes']);
        }

        return $this->productApi->all($pageSize, $data);
    }

    private function buildFilter($catalog)
    {
        $searchBuilder = new SearchBuilder();
        foreach ($catalog['filters'] as $filter) {
            $searchBuilder->addFilter($filter['field'], $filter['operator'], $filter['value']);
        }

        return $searchBuilder->getFilters();
    }
}
