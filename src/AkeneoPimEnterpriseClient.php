<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient;

use Akeneo\Pim\ApiClient\AkeneoPimClient;
use Akeneo\Pim\ApiClient\Api\AssociationTypeApiInterface;
use Akeneo\Pim\ApiClient\Api\AttributeApiInterface;
use Akeneo\Pim\ApiClient\Api\AttributeGroupApiInterface;
use Akeneo\Pim\ApiClient\Api\AttributeOptionApiInterface;
use Akeneo\Pim\ApiClient\Api\CategoryApiInterface;
use Akeneo\Pim\ApiClient\Api\ChannelApiInterface;
use Akeneo\Pim\ApiClient\Api\CurrencyApiInterface;
use Akeneo\Pim\ApiClient\Api\FamilyApiInterface;
use Akeneo\Pim\ApiClient\Api\FamilyVariantApiInterface;
use Akeneo\Pim\ApiClient\Api\LocaleApiInterface;
use Akeneo\Pim\ApiClient\Api\MeasureFamilyApiInterface;
use Akeneo\Pim\ApiClient\Api\MeasurementFamilyApiInterface;
use Akeneo\Pim\ApiClient\Api\MediaFileApiInterface;
use Akeneo\Pim\ApiClient\Api\ProductApiInterface;
use Akeneo\Pim\ApiClient\Api\ProductModelApiInterface;
use Akeneo\Pim\ApiClient\Security\Authentication;
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
 * This class is the implementation of the client to use the Akeneo PIM ENTERPRISE API.
 *
 * @author    Olivier Soulet <olivier.soulet@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class AkeneoPimEnterpriseClient extends AkeneoPimClient implements AkeneoPimEnterpriseClientInterface
{
    /** @var PublishedProductApiInterface */
    private $publishedProductApi;

    /** @var ProductModelDraftApiInterface */
    private $productModelDraftApi;

    /** @var ProductDraftApiInterface */
    private $productDraftApi;

    /** @var AssetApiInterface */
    private $assetApi;

    /** @var AssetCategoryApiInterface */
    private $assetCategoryApi;

    /** @var AssetTagApiInterface */
    private $assetTagApi;

    /** @var AssetReferenceFileApiInterface */
    private $assetReferenceFileApi;

    /** @var AssetVariationFileApiInterface */
    private $assetVariationFileApi;

    /** @var ReferenceEntityRecordApiInterface */
    private $referenceEntityRecordApi;

    /** @var ReferenceEntityMediaFileApiInterface */
    private $referenceEntityMediaFileApi;

    /** @var ReferenceEntityAttributeApiInterface */
    private $referenceEntityAttributeApi;

    /** @var ReferenceEntityAttributeOptionApiInterface */
    private $referenceEntityAttributeOptionApi;

    /** @var ReferenceEntityApiInterface */
    private $referenceEntityApi;

    /** @var AssetManagerApiInterface */
    private $assetManagerApi;

    /** @var AssetFamilyApiInterface */
    private $assetFamilyApi;

    /** @var AssetAttributeApiInterface */
    private $assetAttributeApi;

    /** @var AssetAttributeOptionApiInterface */
    private $assetAttributeOptionApi;

    /** @var AssetMediaFileApiInterface */
    private $assetMediaFileApi;

    public function __construct(
        Authentication $authentication,
        ProductApiInterface $productApi,
        CategoryApiInterface $categoryApi,
        AttributeApiInterface $attributeApi,
        AttributeOptionApiInterface $attributeOptionApi,
        AttributeGroupApiInterface $attributeGroupApi,
        FamilyApiInterface $familyApi,
        MediaFileApiInterface $productMediaFileApi,
        LocaleApiInterface $localeApi,
        ChannelApiInterface $channelApi,
        CurrencyApiInterface $currencyApi,
        MeasureFamilyApiInterface $measureFamilyApi,
        MeasurementFamilyApiInterface $measurementFamilyApi,
        AssociationTypeApiInterface $associationTypeApi,
        FamilyVariantApiInterface $familyVariantApi,
        ProductModelApiInterface $productModelApi,
        ProductModelDraftApiInterface $productModelDraftApi,
        PublishedProductApiInterface $publishedProductApi,
        ProductDraftApiInterface $productDraftApi,
        AssetApiInterface $assetApi,
        AssetCategoryApiInterface $assetCategoryApi,
        AssetTagApiInterface $assetTagApi,
        AssetReferenceFileApiInterface $assetReferenceFileApi,
        AssetVariationFileApiInterface $assetVariationFileApi,
        ReferenceEntityRecordApiInterface $referenceEntityRecordApi,
        ReferenceEntityMediaFileApiInterface $referenceEntityMediaFileApi,
        ReferenceEntityAttributeApiInterface $referenceEntityAttributeApi,
        ReferenceEntityAttributeOptionApiInterface $referenceEntityAttributeOptionApi,
        ReferenceEntityApiInterface $referenceEntityApi,
        AssetManagerApiInterface $assetManagerApi,
        AssetFamilyApiInterface $assetFamilyApi,
        AssetAttributeApiInterface $assetAttributeApi,
        AssetAttributeOptionApiInterface $assetAttributeOptionApi,
        AssetMediaFileApiInterface $assetMediaFileApi
    ) {
        parent::__construct(
            $authentication,
            $productApi,
            $categoryApi,
            $attributeApi,
            $attributeOptionApi,
            $attributeGroupApi,
            $familyApi,
            $productMediaFileApi,
            $localeApi,
            $channelApi,
            $currencyApi,
            $measureFamilyApi,
            $measurementFamilyApi,
            $associationTypeApi,
            $familyVariantApi,
            $productModelApi
        );

        $this->publishedProductApi = $publishedProductApi;
        $this->productDraftApi = $productDraftApi;
        $this->productModelDraftApi = $productModelDraftApi;
        $this->assetApi = $assetApi;
        $this->assetCategoryApi = $assetCategoryApi;
        $this->assetTagApi = $assetTagApi;
        $this->assetReferenceFileApi = $assetReferenceFileApi;
        $this->assetVariationFileApi = $assetVariationFileApi;
        $this->referenceEntityRecordApi = $referenceEntityRecordApi;
        $this->referenceEntityMediaFileApi = $referenceEntityMediaFileApi;
        $this->referenceEntityAttributeApi = $referenceEntityAttributeApi;
        $this->referenceEntityAttributeOptionApi = $referenceEntityAttributeOptionApi;
        $this->referenceEntityApi = $referenceEntityApi;
        $this->assetManagerApi = $assetManagerApi;
        $this->assetFamilyApi = $assetFamilyApi;
        $this->assetAttributeApi = $assetAttributeApi;
        $this->assetAttributeOptionApi = $assetAttributeOptionApi;
        $this->assetMediaFileApi = $assetMediaFileApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getPublishedProductApi(): PublishedProductApiInterface
    {
        return $this->publishedProductApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getProductModelDraftApi(): ProductModelDraftApiInterface
    {
        return $this->productModelDraftApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getProductDraftApi(): ProductDraftApiInterface
    {
        return $this->productDraftApi;
    }

    /**
     * @return AssetApiInterface
     */
    public function getAssetApi(): AssetApiInterface
    {
        return $this->assetApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssetCategoryApi(): AssetCategoryApiInterface
    {
        return $this->assetCategoryApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssetTagApi(): AssetTagApiInterface
    {
        return $this->assetTagApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssetReferenceFileApi(): AssetReferenceFileApiInterface
    {
        return $this->assetReferenceFileApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssetVariationFileApi(): AssetVariationFileApiInterface
    {
        return $this->assetVariationFileApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getReferenceEntityRecordApi(): ReferenceEntityRecordApiInterface
    {
        return $this->referenceEntityRecordApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getReferenceEntityMediaFileApi(): ReferenceEntityMediaFileApiInterface
    {
        return $this->referenceEntityMediaFileApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getReferenceEntityAttributeApi(): ReferenceEntityAttributeApiInterface
    {
        return $this->referenceEntityAttributeApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getReferenceEntityAttributeOptionApi(): ReferenceEntityAttributeOptionApiInterface
    {
        return $this->referenceEntityAttributeOptionApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getReferenceEntityApi(): ReferenceEntityApiInterface
    {
        return $this->referenceEntityApi;
    }

    /**
     * {@inheritDoc}
     */
    public function getAssetManagerApi(): AssetManagerApiInterface
    {
        return $this->assetManagerApi;
    }

    /**
     * {@inheritDoc}
     */
    public function getAssetFamilyApi(): AssetFamilyApiInterface
    {
        return $this->assetFamilyApi;
    }

    /**
     * {@inheritDoc}
     */
    public function getAssetAttributeApi(): AssetAttributeApiInterface
    {
        return $this->assetAttributeApi;
    }

    /**
     * {@inheritDoc}
     */
    public function getAssetAttributeOptionApi(): AssetAttributeOptionApiInterface
    {
        return $this->assetAttributeOptionApi;
    }

    /**
     * {@inheritDoc}
     */
    public function getAssetMediaFileApi(): AssetMediaFileApiInterface
    {
        return $this->assetMediaFileApi;
    }
}
