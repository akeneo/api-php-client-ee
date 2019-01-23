<?php

namespace Akeneo\PimEnterprise\ApiClient;

use Akeneo\Pim\ApiClient\AkeneoPimClientInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetCategoryApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetReferenceFileApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetTagApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetVariationFileApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ProductDraftApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\PublishedProductApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityAttributeApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityAttributeOptionApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityMediaFileApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityRecordApiInterface;

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
     * Gets the product model draft API.
     *
     * @return ProductDraftApiInterface
     */
    public function getProductModelDraftApi();

    /**
     * Gets the product draft API.
     *
     * @return ProductDraftApiInterface
     */
    public function getProductDraftApi();

    /**
     * Gets the asset API.
     *
     * @return AssetApiInterface
     */
    public function getAssetApi();

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

    /**
     * Gets the asset reference file API.
     *
     * @return AssetReferenceFileApiInterface
     */
    public function getAssetReferenceFileApi();

    /**
     * Gets the asset variation file API.
     *
     * @return AssetVariationFileApiInterface
     */
    public function getAssetVariationFileApi();

    /**
     * Gets the reference entity record API.
     *
     * @return ReferenceEntityRecordApiInterface
     */
    public function getReferenceEntityRecordApi();

    /**
     * Gets the reference entity media file API
     *
     * @return ReferenceEntityMediaFileApiInterface
     */
    public function getReferenceEntityMediaFileApi();

    /**
     * Gets the reference entity attribute API.
     *
     * @return ReferenceEntityAttributeApiInterface
     */
    public function getReferenceEntityAttributeApi();

    /**
     * Gets the reference entity attribute option API.
     *
     * @return ReferenceEntityAttributeOptionApiInterface
     */
    public function getReferenceEntityAttributeOptionApi();

    /**
     * Gets the reference entity API.
     *
     * @return ReferenceEntityApiInterface
     */
    public function getReferenceEntityApi();
}
