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
use Akeneo\Pim\ApiClient\Api\MediaFileApiInterface;
use Akeneo\Pim\ApiClient\Api\ProductApiInterface;
use Akeneo\Pim\ApiClient\Api\ProductModelApiInterface;
use Akeneo\Pim\ApiClient\Security\Authentication;
use Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClient;
use Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetCategoryApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetFamilyApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetFamilyAttributeApiInterface;
use Akeneo\PimEnterprise\ApiClient\Api\AssetFamilyAttributeOptionApiInterface;
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
        AssetFamilyApiInterface $assetFamilyApi,
        AssetFamilyAttributeApiInterface $assetFamilyAttributeApi,
        AssetFamilyAttributeOptionApiInterface $assetFamilyAttributeOptionApi
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
            $assetFamilyApi,
            $assetFamilyAttributeApi,
            $assetFamilyAttributeOptionApi
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

    function it_gets_asset_family_api($assetFamilyApi)
    {
        $this->getAssetFamilyApi()->shouldReturn($assetFamilyApi);
    }

    function it_gets_asset_family_attribute_api($assetFamilyAttributeApi)
    {
        $this->getAssetFamilyAttributeApi()->shouldReturn($assetFamilyAttributeApi);
    }

    function it_gets_asset_family_attribute_option_api($assetFamilyAttributeOptionApi)
    {
        $this->getAssetFamilyAttributeOptionApi()->shouldReturn($assetFamilyAttributeOptionApi);
    }
}
