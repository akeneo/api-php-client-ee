<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient;

use Akeneo\Pim\ApiClient\AkeneoPimClientBuilder;
use Akeneo\Pim\ApiClient\Api\AssociationTypeApi;
use Akeneo\Pim\ApiClient\Api\AttributeApi;
use Akeneo\Pim\ApiClient\Api\AttributeGroupApi;
use Akeneo\Pim\ApiClient\Api\AttributeOptionApi;
use Akeneo\Pim\ApiClient\Api\AuthenticationApi;
use Akeneo\Pim\ApiClient\Api\CategoryApi;
use Akeneo\Pim\ApiClient\Api\ChannelApi;
use Akeneo\Pim\ApiClient\Api\CurrencyApi;
use Akeneo\Pim\ApiClient\Api\FamilyApi;
use Akeneo\Pim\ApiClient\Api\FamilyVariantApi;
use Akeneo\Pim\ApiClient\Api\LocaleApi;
use Akeneo\Pim\ApiClient\Api\MeasureFamilyApi;
use Akeneo\Pim\ApiClient\Api\MeasurementFamilyApi;
use Akeneo\Pim\ApiClient\Api\ProductApi;
use Akeneo\Pim\ApiClient\Api\ProductMediaFileApi;
use Akeneo\Pim\ApiClient\Api\ProductModelApi;
use Akeneo\Pim\ApiClient\Client\AuthenticatedHttpClient;
use Akeneo\Pim\ApiClient\Client\HttpClient;
use Akeneo\Pim\ApiClient\Client\ResourceClient;
use Akeneo\Pim\ApiClient\FileSystem\FileSystemInterface;
use Akeneo\Pim\ApiClient\FileSystem\LocalFileSystem;
use Akeneo\Pim\ApiClient\Pagination\PageFactory;
use Akeneo\Pim\ApiClient\Pagination\ResourceCursorFactory;
use Akeneo\Pim\ApiClient\Routing\UriGenerator;
use Akeneo\Pim\ApiClient\Security\Authentication;
use Akeneo\Pim\ApiClient\Stream\MultipartStreamBuilderFactory;
use Akeneo\Pim\ApiClient\Stream\UpsertResourceListResponseFactory;
use Akeneo\PimEnterprise\ApiClient\Api\AssetApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetCategoryApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetApi as AssetManagerApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetAttributeApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetAttributeOptionApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetFamilyApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetManager\AssetMediaFileApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetReferenceFileApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetTagApi;
use Akeneo\PimEnterprise\ApiClient\Api\AssetVariationFileApi;
use Akeneo\PimEnterprise\ApiClient\Api\ProductDraftApi;
use Akeneo\PimEnterprise\ApiClient\Api\ProductModelDraftApi;
use Akeneo\PimEnterprise\ApiClient\Api\PublishedProductApi;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityApi;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityAttributeApi;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityAttributeOptionApi;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityMediaFileApi;
use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityRecordApi;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Builder of the class AkeneoPimEnterpriseClient.
 * This builder is in charge to instantiate and inject the dependencies.
 *
 * @author    Olivier Soulet <olivier.soulet@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class AkeneoPimEnterpriseClientBuilder
{
    /** @var string */
    protected $baseUri;

    /** @var ClientInterface */
    protected $httpClient;

    /** @var RequestFactoryInterface */
    protected $requestFactory;

    /** @var StreamFactoryInterface */
    protected $streamFactory;

    /** @var FileSystemInterface */
    protected $fileSystem;

    /**
     * @param string $baseUri Base uri to request the API
     */
    public function __construct(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * Allows to directly set a client instead of using the discovery
     */
    public function setHttpClient(ClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Allows to directly set a request factory instead of using the discovery
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory): self
    {
        $this->requestFactory = $requestFactory;

        return $this;
    }

    /**
     * Allows to directly set a stream factory instead of using the discovery
     */
    public function setStreamFactory(StreamFactoryInterface $streamFactory): self
    {
        $this->streamFactory = $streamFactory;

        return $this;
    }

    /**
     * Allows to define another implementation than LocalFileSystem
     *
     * @param FileSystemInterface $fileSystem
     *
     * @return AkeneoPimClientBuilder
     */
    public function setFileSystem(FileSystemInterface $fileSystem): self
    {
        $this->fileSystem = $fileSystem;

        return $this;
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
    public function buildAuthenticatedByPassword(string $clientId, string $secret, string $username, string $password): AkeneoPimEnterpriseClientInterface
    {
        $authentication = Authentication::fromPassword($clientId, $secret, $username, $password);

        return $this->buildAuthenticatedClient($authentication);
    }

    /**
     * Build the Akeneo PIM client authenticated by token.
     *
     * @param string $clientId     Client id to use for the authentication
     * @param string $secret       Secret associated to the client
     * @param string $token        Token to use for the authentication
     * @param string $refreshToken Token to use to refresh the access token
     *
     * @return AkeneoPimEnterpriseClientInterface
     */
    public function buildAuthenticatedByToken(string $clientId, string $secret, string $token, string $refreshToken): AkeneoPimEnterpriseClientInterface
    {
        $authentication = Authentication::fromToken($clientId, $secret, $token, $refreshToken);

        return $this->buildAuthenticatedClient($authentication);
    }

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
            new MeasurementFamilyApi($resourceClient),
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
            new ReferenceEntityRecordApi($resourceClient, $pageFactory, $cursorFactory),
            new ReferenceEntityMediaFileApi($resourceClient, $fileSystem),
            new ReferenceEntityAttributeApi($resourceClient),
            new ReferenceEntityAttributeOptionApi($resourceClient),
            new ReferenceEntityApi($resourceClient, $pageFactory, $cursorFactory),
            new AssetManagerApi($resourceClient, $pageFactory, $cursorFactory),
            new AssetFamilyApi($resourceClient, $pageFactory, $cursorFactory),
            new AssetAttributeApi($resourceClient),
            new AssetAttributeOptionApi($resourceClient),
            new AssetMediaFileApi($resourceClient, $fileSystem)
        );

        return $client;
    }

    /**
     * @param Authentication $authentication
     *
     * @return array
     */
    protected function setUp(Authentication $authentication): array
    {
        $uriGenerator = new UriGenerator($this->baseUri);

        $httpClient = new HttpClient($this->getHttpClient(), $this->getRequestFactory(), $this->getStreamFactory());
        $authenticationApi = new AuthenticationApi($httpClient, $uriGenerator);
        $authenticatedHttpClient = new AuthenticatedHttpClient($httpClient, $authenticationApi, $authentication);

        $multipartStreamBuilderFactory = new MultipartStreamBuilderFactory($this->getStreamFactory());
        $upsertListResponseFactory = new UpsertResourceListResponseFactory();
        $resourceClient = new ResourceClient(
            $authenticatedHttpClient,
            $uriGenerator,
            $multipartStreamBuilderFactory,
            $upsertListResponseFactory
        );

        $pageFactory = new PageFactory($authenticatedHttpClient);
        $cursorFactory = new ResourceCursorFactory();
        $fileSystem = null !== $this->fileSystem ? $this->fileSystem : new LocalFileSystem();

        return [$resourceClient, $pageFactory, $cursorFactory, $fileSystem];
    }

    private function getHttpClient(): ClientInterface
    {
        if (null === $this->httpClient) {
            $this->httpClient = Psr18ClientDiscovery::find();
        }

        return $this->httpClient;
    }

    private function getRequestFactory(): RequestFactoryInterface
    {
        if (null === $this->requestFactory) {
            $this->requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        }

        return $this->requestFactory;
    }

    private function getStreamFactory(): StreamFactoryInterface
    {
        if (null === $this->streamFactory) {
            $this->streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        }

        return $this->streamFactory;
    }
}
