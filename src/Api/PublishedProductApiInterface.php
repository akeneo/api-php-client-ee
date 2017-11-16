<?php

namespace Akeneo\PimEnterprise\Api;

use Akeneo\Pim\Api\GettableResourceInterface;
use Akeneo\Pim\Api\ListableResourceInterface;

/**
 * API to manage the published products.
 *
 * @author    Olivier Soulet <olivier.soulet@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
interface PublishedProductApiInterface extends
    ListableResourceInterface,
    GettableResourceInterface
{
}
