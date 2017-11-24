<?php

namespace Akeneo\PimEnterprise\tests\Common\Api\ProductDrafts;

use Akeneo\Pim\tests\CommandLauncher;
use Akeneo\Pim\tests\ValuesSanitizer;
use Akeneo\PimEnterprise\tests\Common\Api\ApiTestCase;

/**
 * @author    Damien Carcel <damien.carcel@gmail.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
abstract class AbstractProductDraftApiTestCase extends ApiTestCase
{
    /**
     * Replaces changing data by specified values.
     *
     * @param array $productDraftData
     *
     * @return array
     */
    protected function sanitizeProductDraftData(array $productDraftData)
    {
        return ValuesSanitizer::sanitize($productDraftData);
    }
}
