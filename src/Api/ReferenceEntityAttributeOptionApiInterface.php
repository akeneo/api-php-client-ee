<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Exception\HttpException;

/**
 * @author    Laurent Petard <laurent.petard@akeneo.com>
 * @copyright 2018 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
interface ReferenceEntityAttributeOptionApiInterface
{
    /**
     * Get an attribute option for a given attribute of a given reference entity.
     *
     * @param string $referenceEntityCode Code of the reference entity
     * @param string $attributeCode       Code of the attribute
     * @param string $attributeOptionCode Code of the attribute option
     *
     * @throws HttpException If the request failed.
     *
     * @return array
     */
    public function get(string $referenceEntityCode, string $attributeCode, string $attributeOptionCode): array;


}
