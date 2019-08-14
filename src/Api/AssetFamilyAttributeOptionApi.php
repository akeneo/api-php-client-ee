<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;

class AssetFamilyAttributeOptionApi implements AssetFamilyAttributeOptionApiInterface
{
    const ASSET_FAMILY_ATTRIBUTE_OPTION_URI = 'api/rest/v1/asset-families/%s/attributes/%s/options/%s';
    const ASSET_FAMILY_ATTRIBUTE_OPTIONS_URI = 'api/rest/v1/asset-families/%s/attributes/%s/options';

    /** @var ResourceClientInterface */
    private $resourceClient;

    public function __construct(ResourceClientInterface $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $assetFamilyCode, string $attributeCode, string $attributeOptionCode): array
    {
        return $this->resourceClient->getResource(
            static::ASSET_FAMILY_ATTRIBUTE_OPTION_URI,
            [$assetFamilyCode, $attributeCode, $attributeOptionCode]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function all(string $assetFamilyCode, string $attributeCode): array
    {
        return $this->resourceClient->getResource(
            static::ASSET_FAMILY_ATTRIBUTE_OPTIONS_URI,
            [$assetFamilyCode, $attributeCode]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function upsert(string $assetFamilyCode, string $attributeCode, string $attributeOptionCode, array $data = []): int
    {
        return $this->resourceClient->upsertResource(
            static::ASSET_FAMILY_ATTRIBUTE_OPTION_URI,
            [$assetFamilyCode, $attributeCode, $attributeOptionCode],
            $data
        );
    }
}
