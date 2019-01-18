<?php

namespace Akeneo\PimEnterprise\ApiClient;

use Akeneo\Pim\ApiClient\AkeneoPimClientBuilder;
use Akeneo\Pim\ApiClient\Api\AssociationTypeApi;
use Akeneo\Pim\ApiClient\Api\AttributeApi;
use Akeneo\Pim\ApiClient\Api\AttributeGroupApi;
use Akeneo\Pim\ApiClient\Api\AttributeOptionApi;
use Akeneo\Pim\ApiClient\Api\CategoryApi;
use Akeneo\Pim\ApiClient\Api\ChannelApi;
use Akeneo\Pim\ApiClient\Api\CurrencyApi;
use Akeneo\Pim\ApiClient\Api\FamilyApi;
use Akeneo\Pim\ApiClient\Api\FamilyVariantApi;
use Akeneo\Pim\ApiClient\Api\LocaleApi;
use Akeneo\Pim\ApiClient\Api\MeasureFamilyApi;
use Akeneo\Pim\ApiClient\Api\ProductApi;
use Akeneo\Pim\ApiClient\Api\ProductMediaFileApi;
use Akeneo\Pim\ApiClient\Api\ProductModelApi;
use Akeneo\Pim\ApiClient\Security\Authentication;
use Akeneo\PimEnterprise\ApiClient\Api\AssetApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetCategoryApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetReferenceFileApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetTagApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetVariationFileApi;
use Akeneo\PimEnterprise\ApiClient\Api\ProductDraftApi;
use Akeneo\PimEnterprise\ApiClient\Api\ProductModelDraftApi;
use Akeneo\PimEnterprise\ApiClient\Api\PublishedProductApi;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityRecordApi;

/**
 * Builder of the class AkeneoPimEnterpriseClient.
 * This builder is in charge to instantiate and inject the dependencies.
 *
 * @author    Olivier Soulet <olivier.soulet@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class AkeneoPimEnterpriseClientBuilder extends AkeneoPimClientBuilder
{
    /**
     * @param Authentication $authentication
     *
     * @return AkeneoPimEnterpriseClientInterface
     */
    protected function buildAuthenticatedClient(Authentication $authentication)
    {
        list($resourceClient, $pageFactory, $cursorFactory, $fileSystem) = $this->setUp($authentication);

        $client = new AkeneoPimEnterpriseClient(
            $authentication,
            new ProductApi($resourceClient, $pageFactory, $cursorFactory),
            new CategoryApi($resourceClient, $pageFactory, $cursorFactory),
            new AttributeApi($resourceClient, $pageFactory, $cursorFactory),
            new AttributeOptionApi($resourceClient, $pageFactory, $cursorFactory),
            new AttributeGroupApi($resourceClient, $pageFactory, $cursorFactory),
            new FamilyApi($resourceClient, $pageFactory, $cursorFactory),
            new ProductMediaFileApi($resourceClient, $pageFactory, $cursorFactory, $fileSystem),
            new LocaleApi($resourceClient, $pageFactory, $cursorFactory),
            new ChannelApi($resourceClient, $pageFactory, $cursorFactory),
            new CurrencyApi($resourceClient, $pageFactory, $cursorFactory),
            new MeasureFamilyApi($resourceClient, $pageFactory, $cursorFactory),
            new AssociationTypeApi($resourceClient, $pageFactory, $cursorFactory),
            new FamilyVariantApi($resourceClient, $pageFactory, $cursorFactory),
            new ProductModelApi($resourceClient, $pageFactory, $cursorFactory),
            new ProductModelDraftApi($resourceClient, $pageFactory, $cursorFactory),
            new PublishedProductApi($resourceClient, $pageFactory, $cursorFactory),
            new ProductDraftApi($resourceClient, $pageFactory, $cursorFactory),
            new AssetApi($resourceClient, $pageFactory, $cursorFactory),
            new AssetCategoryApi($resourceClient, $pageFactory, $cursorFactory),
            new AssetTagApi($resourceClient, $pageFactory, $cursorFactory),
            new AssetReferenceFileApi($resourceClient, $fileSystem),
            new AssetVariationFileApi($resourceClient, $fileSystem),
            new ReferenceEntityRecordApi($resourceClient, $pageFactory, $cursorFactory)
        );

        return $client;
    }

    /**
     * Build the Akeneo PIM client authenticated by user name and password.
     *
     * @param string $clientId Client id to use for the authentication
     * @param string $secret   Secret associated to the client
     * @param string $username Username to use for the authentication
     * @param string $password Password associated to the username
     *
     * @return AkeneoPimEnterpriseClientInterface
     */
    public function buildAuthenticatedByPassword($clientId, $secret, $username, $password)
    {
        $authentication = Authentication::fromPassword($clientId, $secret, $username, $password);

        return $this->buildAuthenticatedClient($authentication);
    }
}
