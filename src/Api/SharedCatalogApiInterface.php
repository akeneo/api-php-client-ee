<?php

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;

interface SharedCatalogApiInterface
{
    public function search(string $catalogCode, int $pageSize = 10): ResourceCursorInterface;
}
