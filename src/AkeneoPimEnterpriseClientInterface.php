<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient;

use Akeneo\Pim\ApiClient\AkeneoPimClientInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetCategoryApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetApiInterface as AssetManagerApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetAttributeApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetAttributeOptionApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetFamilyApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetMediaFileApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetReferenceFileApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetTagApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetVariationFileApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ProductDraftApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ProductModelDraftApiInterface;
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
    public function getPublishedProductApi(): PublishedProductApiInterface;

    public function getProductModelDraftApi(): ProductModelDraftApiInterface;

    public function getProductDraftApi(): ProductDraftApiInterface;

    public function getAssetApi(): AssetApiInterface;

    public function getAssetCategoryApi(): AssetCategoryApiInterface;

    public function getAssetTagApi(): AssetTagApiInterface;

    public function getAssetReferenceFileApi(): AssetReferenceFileApiInterface;

    public function getAssetVariationFileApi(): AssetVariationFileApiInterface;

    public function getReferenceEntityRecordApi(): ReferenceEntityRecordApiInterface;

    public function getReferenceEntityMediaFileApi(): ReferenceEntityMediaFileApiInterface;

    public function getReferenceEntityAttributeApi(): ReferenceEntityAttributeApiInterface;

    public function getReferenceEntityAttributeOptionApi(): ReferenceEntityAttributeOptionApiInterface;

    public function getReferenceEntityApi(): ReferenceEntityApiInterface;

    public function getAssetManagerApi(): AssetManagerApiInterface;

    public function getAssetFamilyApi(): AssetFamilyApiInterface;

    public function getAssetAttributeApi(): AssetAttributeApiInterface;

    public function getAssetAttributeOptionApi(): AssetAttributeOptionApiInterface;

    public function getAssetMediaFileApi(): AssetMediaFileApiInterface;
}
