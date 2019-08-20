<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\Api\AssetManager;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;

class AssetApi implements AssetApiInterface
{
    const ASSET_URI= 'api/rest/v1/asset-families/%s/assets/%s';
    const ASSETS_URI = 'api/rest/v1/asset-families/%s/assets';

    /** @var ResourceClientInterface */
    private $resourceClient;

    public function __construct(ResourceClientInterface $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }

    /**
     * {@inheritdoc}
     */
    public function upsert(string $assetFamilyCode, string $assetCode, array $data = []): int
    {
        return $this->resourceClient->upsertResource(static::ASSET_URI, [$assetFamilyCode, $assetCode], $data);
    }

    /**
     * {@inheritdoc}
     */
    public function upsertList(string $assetFamilyCode, array $assets): array
    {
        return $this->resourceClient->upsertJsonResourceList(static::ASSETS_URI, [$assetFamilyCode], $assets);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $assetFamilyCode, string $assetCode): int
    {
        return $this->resourceClient->deleteResource(static::ASSET_URI, [$assetFamilyCode, $assetCode]);
    }
}