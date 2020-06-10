<?php

namespace Akeneo\PimEnterprise\ApiClient\Search;

use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;

interface SharedCatalogBuilderInterface
{
    public function search($catalogCode): ResourceCursorInterface;
}
