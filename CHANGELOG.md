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
