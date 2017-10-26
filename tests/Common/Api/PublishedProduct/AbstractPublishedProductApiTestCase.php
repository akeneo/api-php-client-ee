<?php

namespace Akeneo\PimEnterprise\tests\Common\Api\PublishedProduct;

use Akeneo\PimEnterprise\tests\Common\Api\ApiTestCase;
use Akeneo\Pim\tests\DateSanitizer;
use Akeneo\Pim\tests\MediaSanitizer;

/**
 * @author    Olivier Soulet <olivier.soulet@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
abstract class AbstractPublishedProductApiTestCase extends ApiTestCase
{
    /**
     * Replaces changing data by specified values.
     *
     * @param array $publishedProductData
     *
     * @return array
     */
    protected function sanitizePublishedProductData(array $publishedProductData)
    {
        foreach ($publishedProductData as $key => $value) {
            if (is_array($value)) {
                $publishedProductData[$key] = $this->sanitizePublishedProductData($value);
            } else {
                $publishedProductData[$key] = DateSanitizer::sanitize($publishedProductData[$key]);
                $publishedProductData[$key] = MediaSanitizer::sanitize($publishedProductData[$key]);
            }
        }

        return $publishedProductData;
    }
}
