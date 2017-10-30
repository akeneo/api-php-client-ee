<?php

namespace Akeneo\PimEnterprise;

use Akeneo\Pim\AkeneoPimClientInterface;
use Akeneo\PimEnterprise\Api\PublishedProductApiInterface;

/**
 * Client to use the Akeneo PIM ENTERPRISE API.
 *
 * @author    Olivier Soulet <olivier.soulet@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
interface AkeneoPimEnterpriseClientInterface extends AkeneoPimClientInterface
{
    /**
     * Gets the published product API
     *
     * @return PublishedProductApiInterface
     */
    public function getPublishedProductApi();
}
