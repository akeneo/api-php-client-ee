<?php

namespace Akeneo\PimEnterprise;

use Akeneo\Pim\AkeneoPimClientBuilder;
use Akeneo\Pim\Api\AssociationTypeApi;
use Akeneo\Pim\Api\AttributeApi;
use Akeneo\Pim\Api\AttributeGroupApi;
use Akeneo\Pim\Api\AttributeOptionApi;
use Akeneo\Pim\Api\AuthenticationApi;
use Akeneo\Pim\Api\CategoryApi;
use Akeneo\Pim\Api\ChannelApi;
use Akeneo\Pim\Api\CurrencyApi;
use Akeneo\Pim\Api\FamilyApi;
use Akeneo\Pim\Api\FamilyVariantApi;
use Akeneo\Pim\Api\LocaleApi;
use Akeneo\Pim\Api\MeasureFamilyApi;
use Akeneo\Pim\Api\ProductApi;
use Akeneo\Pim\Api\ProductMediaFileApi;
use Akeneo\Pim\Api\ProductModelApi;
use Akeneo\Pim\Client\AuthenticatedHttpClient;
use Akeneo\Pim\Client\HttpClient;
use Akeneo\Pim\Client\ResourceClient;
use Akeneo\Pim\Pagination\PageFactory;
use Akeneo\Pim\Pagination\ResourceCursorFactory;
use Akeneo\Pim\Routing\UriGenerator;
use Akeneo\Pim\Security\Authentication;
use Akeneo\Pim\Stream\MultipartStreamBuilderFactory;
use Akeneo\Pim\Stream\UpsertResourceListResponseFactory;
use Akeneo\PimEnterprise\Api\PublishedProductApi;

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
     * @param string $baseUri Base uri to request the API
     */
    public function __construct($baseUri)
    {
        parent::__construct($baseUri);
    }

    /**
     * @param Authentication $authentication
     *
     * @return AkeneoPimEnterpriseClientInterface
     */
    protected function buildAuthenticatedClient(Authentication $authentication)
    {
        list($resourceClient, $pageFactory, $cursorFactory) = $this->setUp($authentication);

        $client = new AkeneoPimEnterpriseClient(
            $authentication,
            new ProductApi($resourceClient, $pageFactory, $cursorFactory),
            new CategoryApi($resourceClient, $pageFactory, $cursorFactory),
            new AttributeApi($resourceClient, $pageFactory, $cursorFactory),
            new AttributeOptionApi($resourceClient, $pageFactory, $cursorFactory),
            new AttributeGroupApi($resourceClient, $pageFactory, $cursorFactory),
            new FamilyApi($resourceClient, $pageFactory, $cursorFactory),
            new ProductMediaFileApi($resourceClient, $pageFactory, $cursorFactory),
            new LocaleApi($resourceClient, $pageFactory, $cursorFactory),
            new ChannelApi($resourceClient, $pageFactory, $cursorFactory),
            new CurrencyApi($resourceClient, $pageFactory, $cursorFactory),
            new MeasureFamilyApi($resourceClient, $pageFactory, $cursorFactory),
            new AssociationTypeApi($resourceClient, $pageFactory, $cursorFactory),
            new FamilyVariantApi($resourceClient, $pageFactory, $cursorFactory),
            new ProductModelApi($resourceClient, $pageFactory, $cursorFactory),
            new PublishedProductApi($resourceClient, $pageFactory, $cursorFactory)
        );

        return $client;
    }
}
