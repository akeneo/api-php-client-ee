<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Pagination\ResourceCursorInterface;

interface AssetFamilyApiInterface
{
    public function get(string $referenceEntityCode): array;

    public function all(array $queryParameters = []): ResourceCursorInterface;

    public function upsert(string $referenceEntityCode, array $data = []): int;

    public function upsertList(array $referenceEntities): array;
}
