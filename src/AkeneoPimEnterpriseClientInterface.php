<?php

namespace Akeneo\PimEnterprise\ApiClient;

use Akeneo\Pim\ApiClient\AkeneoPimClientInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetCategoryApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetTagApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ProductDraftApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\PublishedProductApiInterface;

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
     * Gets the published product API.
     *
     * @return PublishedProductApiInterface
     */
    public function getPublishedProductApi();

    /**
     * Gets the product draft API.
     *
     * @return ProductDraftApiInterface
     */
    public function getProductDraftApi();

    /**
     * Gets the asset category API.
     *
     * @return AssetCategoryApiInterface
     */
    public function getAssetCategoryApi();

    /**
     * Gets the asset tag API.
     *
     * @return AssetTagApiInterface
     */
    public function getAssetTagApi();
}
