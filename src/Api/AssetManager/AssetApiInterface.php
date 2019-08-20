<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\Api\AssetManager;

use Akeneo\Pim\ApiClient\Exception\HttpException;

interface AssetApiInterface
{
    /**
     * Creates an asset family if it does not exist yet, otherwise updates partially the asset family.
     *
     * @throws HttpException
     *
     * @return int Status code 201 indicating that the asset family has been well created.
     *             Status code 204 indicating that the asset family has been well updated.
     */
    public function upsert(string $assetFamilyCode, string $assetCode, array $data = []): int;

    /**
     * Updates or creates several assets.
     *
     * @param string $assetFamilyCode Code of the asset family
     * @param array  $assets          Array containing the assets to create or update
     *
     * @throws HttpException
     *
     * @return array returns the list of the responses of each created or updated asset.
     */
    public function upsertList(string $assetFamilyCode, array $assets): array;

    /**
     * Deletes an asset.
     *
     * @param string $assetFamilyCode code of the asset family
     * @param string $assetCode       code of the asset to delete
     *
     * @throws HttpException
     *
     * @return int Status code 204 indicating that the resource has been well deleted.
     */
    public function delete(string $assetFamilyCode, string $assetCode): int;
}
