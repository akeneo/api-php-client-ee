<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Exception\HttpException;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;

interface CatalogApiInterface
{
    public function all(): array;

    public function get($code): array;
}
