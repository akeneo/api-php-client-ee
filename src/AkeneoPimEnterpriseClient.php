<?php

namespace Akeneo\PimEnterprise;

use Akeneo\Pim\AkeneoPimClient;
use Akeneo\Pim\Api\AssociationTypeApiInterface;
use Akeneo\Pim\Api\AttributeApiInterface;
use Akeneo\Pim\Api\AttributeGroupApiInterface;
use Akeneo\Pim\Api\AttributeOptionApiInterface;
use Akeneo\Pim\Api\CategoryApiInterface;
use Akeneo\Pim\Api\ChannelApiInterface;
use Akeneo\Pim\Api\CurrencyApiInterface;
use Akeneo\Pim\Api\FamilyApiInterface;
use Akeneo\Pim\Api\LocaleApiInterface;
use Akeneo\Pim\Api\MeasureFamilyApiInterface;
use Akeneo\Pim\Api\MediaFileApiInterface;
use Akeneo\Pim\Api\ProductApiInterface;
use Akeneo\Pim\Security\Authentication;
use Akeneo\PimEnterprise\Api\PublishedProductApiInterface;

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
    protected $publishedProductApi;

    /**
     * @param Authentication               $authentication
     * @param ProductApiInterface          $productApi
     * @param CategoryApiInterface         $categoryApi
     * @param AttributeApiInterface        $attributeApi
     * @param AttributeOptionApiInterface  $attributeOptionApi
     * @param AttributeGroupApiInterface   $attributeGroupApi
     * @param FamilyApiInterface           $familyApi
     * @param MediaFileApiInterface        $productMediaFileApi
     * @param LocaleApiInterface           $localeApi
     * @param ChannelApiInterface          $channelApi
     * @param CurrencyApiInterface         $currencyApi
     * @param MeasureFamilyApiInterface    $measureFamilyApi
     * @param AssociationTypeApiInterface  $associationTypeApi
     * @param PublishedProductApiInterface $publishedProductApi
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
        PublishedProductApiInterface $publishedProductApi
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
            $associationTypeApi
        );

        $this->publishedProductApi = $publishedProductApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getPublishedProductApi()
    {
        return $this->publishedProductApi;
    }
}
