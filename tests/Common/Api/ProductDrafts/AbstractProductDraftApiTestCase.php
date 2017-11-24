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
     * Creates a product draft, incarnating a specified user.
     *
     * @param string $identifier
     * @param array  $data
     * @param string $user
     */
    protected function createDraft($identifier, array $data, $user)
    {
        $this->getCommandLauncher()->launch(sprintf(
            'pim:draft:create %s \'%s\' %s',
            $identifier,
            json_encode($data),
            $user
        ));
    }

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
