<?php

namespace Akeneo\PimEnterprise\tests\Common\Api\PublishedProduct;

use Akeneo\Pim\tests\ConsoleCommandLauncher;
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
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        // Important: As "big_boot" is associated with "small_boot" and
        // "medium_boot", those two must be published first.
        $this->publishProducts([
            'small_boot',
            'medium_boot',
            'big_boot',
            'black_sneakers',
            'dance_shoe',
            'docks_black',
            'docks_blue',
            'docks_maroon',
            'docks_red',
            'docks_white',
        ]);

        // We need to wait that all published products are indexed.
        sleep(5);
    }

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

    /**
     * Publishes a list of product.
     *
     * @param string[] $identifiers
     */
    protected function publishProducts(array $identifiers)
    {
        foreach ($identifiers as $identifier) {
            $this->getCommandLauncher()->launch(sprintf('pim:product:publish %s', $identifier));
        }
    }
}
