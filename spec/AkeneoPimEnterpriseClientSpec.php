<?php

namespace spec\Akeneo\PimEnterprise;

use Akeneo\Pim\Api\AssociationTypeApiInterface;
use Akeneo\Pim\Api\AttributeApiInterface;
use Akeneo\Pim\Api\AttributeGroupApiInterface;
use Akeneo\Pim\Api\AttributeOptionApiInterface;
use Akeneo\Pim\Api\CategoryApiInterface;
use Akeneo\Pim\Api\ChannelApiInterface;
use Akeneo\Pim\Api\CurrencyApiInterface;
use Akeneo\Pim\Api\FamilyApiInterface;
use Akeneo\Pim\Api\FamilyVariantApiInterface;
use Akeneo\Pim\Api\LocaleApiInterface;
use Akeneo\Pim\Api\MeasureFamilyApiInterface;
use Akeneo\Pim\Api\MediaFileApiInterface;
use Akeneo\Pim\Api\ProductApiInterface;
use Akeneo\Pim\Api\ProductModelApiInterface;
use Akeneo\Pim\Security\Authentication;
use Akeneo\PimEnterprise\AkeneoPimEnterpriseClient;
use Akeneo\PimEnterprise\AkeneoPimEnterpriseClientInterface;
use Akeneo\PimEnterprise\Api\ProductDraftApiInterface;
use Akeneo\PimEnterprise\Api\PublishedProductApiInterface;
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
        PublishedProductApiInterface $publishedProductApi,
        ProductDraftApiInterface $productDraftApi
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
            $publishedProductApi,
            $productDraftApi
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
}
