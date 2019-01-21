<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Exception\HttpException;

/**
 * @author    Laurent Petard <laurent.petard@akeneo.com>
 * @copyright 2018 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
interface ReferenceEntityAttributeApiInterface
{
    /**
     * Gets a single reference entity record.
     *
     * @param string $referenceEntityCode Code of the reference entity
     * @param string $attributeCode       Code of the attribute
     *
     * @throws HttpException If the request failed.
     *
     * @return array
     */
    public function get(string $referenceEntityCode, string $attributeCode): array;
}
