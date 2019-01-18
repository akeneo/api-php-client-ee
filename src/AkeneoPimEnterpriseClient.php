<?php

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
use Akeneo\Pim\ApiClient\Api\MediaFileApiInterface;
use Akeneo\Pim\ApiClient\Api\ProductApiInterface;
use Akeneo\Pim\ApiClient\Api\ProductModelApiInterface;
use Akeneo\Pim\ApiClient\Security\Authentication;
use Akeneo\PimEnterprise\ApiClient\Api\AssetApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetCategoryApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetReferenceFileApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetTagApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetVariationFileApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ProductDraftApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ProductModelDraftApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\PublishedProductApiInterface;
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

    /**
     * @param Authentication                       $authentication
     * @param ProductApiInterface                  $productApi
     * @param CategoryApiInterface                 $categoryApi
     * @param AttributeApiInterface                $attributeApi
     * @param AttributeOptionApiInterface          $attributeOptionApi
     * @param AttributeGroupApiInterface           $attributeGroupApi
     * @param FamilyApiInterface                   $familyApi
     * @param MediaFileApiInterface                $productMediaFileApi
     * @param LocaleApiInterface                   $localeApi
     * @param ChannelApiInterface                  $channelApi
     * @param CurrencyApiInterface                 $currencyApi
     * @param MeasureFamilyApiInterface            $measureFamilyApi
     * @param AssociationTypeApiInterface          $associationTypeApi
     * @param FamilyVariantApiInterface            $familyVariantApi
     * @param ProductModelApiInterface             $productModelApi
     * @param ProductModelDraftApiInterface        $productModelDraftApi
     * @param PublishedProductApiInterface         $publishedProductApi
     * @param ProductDraftApiInterface             $productDraftApi
     * @param AssetApiInterface                    $assetApi
     * @param AssetCategoryApiInterface            $assetCategoryApi
     * @param AssetTagApiInterface                 $assetTagApi
     * @param AssetReferenceFileApiInterface       $assetReferenceFileApi
     * @param AssetVariationFileApiInterface       $assetVariationFileApi
     * @param ReferenceEntityRecordApiInterface    $referenceEntityRecordApi
     * @param ReferenceEntityMediaFileApiInterface $referenceEntityMediaFileApi
     */
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
        ReferenceEntityMediaFileApiInterface $referenceEntityMediaFileApi
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
    }

    /**
     * {@inheritdoc}
     */
    public function getPublishedProductApi()
    {
        return $this->publishedProductApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getProductModelDraftApi()
    {
        return $this->productModelDraftApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getProductDraftApi()
    {
        return $this->productDraftApi;
    }

    /**
     * @return AssetApiInterface
     */
    public function getAssetApi()
    {
        return $this->assetApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssetCategoryApi()
    {
        return $this->assetCategoryApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssetTagApi()
    {
        return $this->assetTagApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssetReferenceFileApi()
    {
        return $this->assetReferenceFileApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssetVariationFileApi()
    {
        return $this->assetVariationFileApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getReferenceEntityRecordApi()
    {
        return $this->referenceEntityRecordApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getReferenceEntityMediaFileAPi()
    {
        return $this->referenceEntityMediaFileApi;
    }
}
