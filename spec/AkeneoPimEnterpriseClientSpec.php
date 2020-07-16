<?php

namespace spec\Akeneo\PimEnterprise\ApiClient;

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
use Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClient;
use Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetCategoryApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetApiInterface as AssetManagerApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetFamilyApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetAttributeApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetAttributeOptionApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetMediaFileApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetReferenceFileApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetTagApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetVariationFileApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ProductDraftApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ProductModelDraftApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\PublishedProductApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityAttributeApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityAttributeOptionApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityMediaFileApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityRecordApiInterface;
use PhpSpec\ObjectBehavior;

class AkeneoPimEnterpriseClientSpec extends ObjectBehavior
{
    function let(
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
        $this->beConstructedWith(
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
            $productModelApi,
            $productModelDraftApi,
            $publishedProductApi,
            $productDraftApi,
            $assetApi,
            $assetCategoryApi,
            $assetTagApi,
            $assetReferenceFileApi,
            $assetVariationFileApi,
            $referenceEntityRecordApi,
            $referenceEntityMediaFileApi,
            $referenceEntityAttributeApi,
            $referenceEntityAttributeOptionApi,
            $referenceEntityApi,
            $assetManagerApi,
            $assetFamilyApi,
            $assetAttributeApi,
            $assetAttributeOptionApi,
            $assetMediaFileApi
        );
    }

    function it_is_initializable()
    {
        $this->shouldImplement(AkeneoPimEnterpriseClientInterface::class);
        $this->shouldHaveType(AkeneoPimEnterpriseClient::class);
    }

    function it_gets_published_product_api($publishedProductApi)
    {
        $this->getPublishedProductApi()->shouldReturn($publishedProductApi);
    }

    function it_gets_draft_product_api($productDraftApi)
    {
        $this->getProductDraftApi()->shouldReturn($productDraftApi);
    }

    function it_gets_draft_product_model_api($productModelDraftApi)
    {
        $this->getProductModelDraftApi()->shouldReturn($productModelDraftApi);
    }

    function it_gets_asset_api($assetApi)
    {
        $this->getAssetApi()->shouldReturn($assetApi);
    }

    function it_gets_asset_category_api($assetCategoryApi)
    {
        $this->getAssetCategoryApi()->shouldReturn($assetCategoryApi);
    }

    function it_gets_asset_tags_api($assetTagApi)
    {
        $this->getAssetTagApi()->shouldReturn($assetTagApi);
    }

    function it_gets_asset_reference_file_api($assetReferenceFileApi)
    {
        $this->getAssetReferenceFileApi()->shouldReturn($assetReferenceFileApi);
    }

    function it_gets_reference_entity_record_api($referenceEntityRecordApi)
    {
        $this->getReferenceEntityRecordApi()->shouldReturn($referenceEntityRecordApi);
    }

    function it_gets_reference_entity_media_file_api($referenceEntityMediaFileApi)
    {
        $this->getReferenceEntityMediaFileApi()->shouldReturn($referenceEntityMediaFileApi);
    }

    function it_gets_reference_entity_attribute_api($referenceEntityAttributeApi)
    {
        $this->getReferenceEntityAttributeApi()->shouldReturn($referenceEntityAttributeApi);
    }

    function it_gets_reference_entity_api($referenceEntityApi)
    {
        $this->getReferenceEntityApi()->shouldReturn($referenceEntityApi);
    }

    function it_gets_asset_manager_api($assetManagerApi)
    {
        $this->getAssetManagerApi()->shouldReturn($assetManagerApi);
    }

    function it_gets_asset_family_api($assetFamilyApi)
    {
        $this->getAssetFamilyApi()->shouldReturn($assetFamilyApi);
    }

    function it_gets_asset_attribute_api($assetAttributeApi)
    {
        $this->getAssetAttributeApi()->shouldReturn($assetAttributeApi);
    }

    function it_gets_asset_attribute_option_api($assetAttributeOptionApi)
    {
        $this->getAssetAttributeOptionApi()->shouldReturn($assetAttributeOptionApi);
    }

    function it_gets_asset_media_file_api($assetMediaFileApi)
    {
        $this->getAssetMediaFileApi()->shouldReturn($assetMediaFileApi);
    }
}
