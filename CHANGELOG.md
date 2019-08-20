
# 6.0.0

## Improvements

Addition of the Asset manager end-points:

- Get an asset family
- Get a list of asset families
- Upsert an asset family
- Get an asset family attribute
- Get a list of asset family attributes
- Upsert an asset family attribute
- Get an asset family attribute option
- Get a list of asset family attribute options
- Upsert an asset family attribute option
- Upsert an asset
- Upsert a list of assets
- Delete an asset

# 5.0.0

## BC Breaks

Use PSR-7, PSR-17 and PSR-18 instead of HttpPlug.

- Change the type of the first parameter of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientBuilder::setHttpClient` from `Http\Client\HttpClient` to `Psr\Http\Client\ClientInterface`
- Change the type of the first parameter of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientBuilder::setRequestFactory` from `Http\Message\RequestFactory` to `Psr\Http\Message\RequestFactoryInterface`
- Change the type of the first parameter of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientBuilder::setStreamFactory` from `Http\Message\StreamFactory` to `Psr\Http\Message\StreamFactoryInterface`

Factory implementations are necessary as dependency.
For example, with Guzzle:

```bash
$ php composer.phar require akeneo/api-php-client-ee php-http/guzzle6-adapter:^2.0 http-interop/http-factory-guzzle:^1.0
```

# 4.0.2 (2019-03-06)

- Add support for PHP 7.1

# 4.0.1 (2019-03-06)

## BC breaks

- Remove Upsert a list of reference entities (the method was doing nothing and doesn't exist in the API)

# 4.0.0 (2019-02-08)

## Improvements

Addition of the reference entity end-points:

- Get a single reference entity
- Get a list of reference entities
- Upsert a single reference entity
- Upsert a list of reference entities
- Get a single reference entity record
- Get a list of reference entity records
- Upsert a single reference entity record
- Upsert a list of reference entity records
- Get a single reference entity attribute
- Get a list of reference entity attributes
- Upsert a single reference entity attribute
- Get a single reference entity attribute option
- Get a list of reference entity attribute options
- Upsert a single reference entity attribute option
- Download a reference entity media file
- Create a reference entity media file

## BC breaks
 
- Add method `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface::getReferenceEntityApi`
- Change the constructor of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClient` to add `Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityApiInterface`
- Add method `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface::getReferenceEntityRecordApi`
- Change the constructor of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClient` to add `Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityRecordApiInterface`
- Add method `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface::getReferenceEntityAttributeApi`
- Change the constructor of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClient` to add `Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityAttributeApiInterface`
- Add method `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface::getReferenceEntityAttributeOptionApi`
- Change the constructor of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClient` to add `Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityAttributeOptionApiInterface`
- Add method `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface::getReferenceEntityMediaFileApi`
- Change the constructor of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClient` to add `Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityMediaFileApiInterface`

- Change the response type from `Psr\Http\Message\StreamInterface` to `Psr\Http\Message\ResponseInterface` for `Akeneo\Pim\ApiClient\Api\MediaFileApiInterface::download`
- Change the response type from `Psr\Http\Message\StreamInterface` to `Psr\Http\Message\ResponseInterface` for `Akeneo\PimEnterprise\ApiClient\Api\AssetVariationFileApiInterface::downloadFromLocalizableAsset`
- Change the response type from `Psr\Http\Message\StreamInterface` to `Psr\Http\Message\ResponseInterface` for `Akeneo\PimEnterprise\ApiClient\Api\AssetVariationFileApiInterface::downloadFromNotLocalizableAsset`
- Change the response type from `Psr\Http\Message\StreamInterface` to `Psr\Http\Message\ResponseInterface` for `Akeneo\PimEnterprise\ApiClient\Api\AssetReferenceFileApiInterface::downloadFromNotLocalizableAsset`
- Change the response type from `Psr\Http\Message\StreamInterface` to `Psr\Http\Message\ResponseInterface` for `Akeneo\PimEnterprise\ApiClient\Api\AssetReferenceFileApiInterface::downloadFromLocalizableAsset`

It allows to get the filename from the response, and also the Mime type.
To get the content you can do `$response->getBody()->getContent()` (previously `$response->getContent()`.

## BC Breaks

Drop support for PHP 5.6, PHP 7.0 and PHP 7.1

# 3.0.0 (2018-06-26)

## Improvements

- API-602: Get a draft of product model and submit it for approval

## BC breaks

- Add method `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface::getProductModelDraftApi`
- Change the constructor of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClient` to add `Akeneo\PimEnterprise\ApiClient\Api\ProductModelDraftApiInterface`

# 2.0.1 (2018-05-03)

# 2.0.0 (2018-02-19)

## Improvements

- API-466: Get a single asset category
- API-468: Get a list of asset categories
- API-472: upsert a single asset category
- API-474: upsert a list of asset categories
- API-470: Create an asset category
- API-534-531: Get and upsert an asset tag
- API-538: Get a list of asset tags
- API-477: Get a single asset
- API-480: Get a list of assets
- API-482: Create an asset
- API-484: Upsert a single asset
- API-486: Upsert a list of assets
- API-560: Get and upload an asset reference file
- API-560: handle asset reference file upload response errors
- API-560: download an asset reference file
- API-561: Get and upload an asset variation file
- API-561: download an asset variation file

## BC breaks

- Add method `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface::getAssetCategoryApi`
- Change the constructor of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClient` to add `Akeneo\PimEnterprise\ApiClient\Api\AssetCategoryApiInterface`
- Add method `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface::getAssetTagApi`
- Change the constructor of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClient` to add `Akeneo\PimEnterprise\ApiClient\Api\AssetTagApiInterface`
- Add method `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface::getAssetApi`
- Change the constructor of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClient` to add `Akeneo\PimEnterprise\ApiClient\Api\AssetApiInterface`
- Add method `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface::getAssetReferenceFileApi`
- Change the constructor of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClient` to add `Akeneo\PimEnterprise\ApiClient\Api\AssetReferenceFileApiInterface`
- Add method `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface::getAssetVariationFileApi`
- Change the constructor of `Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClient` to add `Akeneo\PimEnterprise\ApiClient\Api\AssetVariationFileApiInterface`
