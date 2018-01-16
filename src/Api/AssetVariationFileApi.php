<?php

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\Pim\ApiClient\FileSystem\FileSystemInterface;

/**
 * Class AssetVariationFileApi
 *
 * @author    Laurent Petard <laurent.petard@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class AssetVariationFileApi implements AssetVariationFileApiInterface
{
    const ASSET_VARIATION_FILE_URI = '/api/rest/v1/assets/%s/variation-files/%s/%s';
    const ASSET_VARIATION_FILE_DOWNLOAD_URI = '/api/rest/v1/assets/%s/variation-files/%s/%s/download';
    const NOT_LOCALIZABLE_ASSET_LOCALE_CODE = 'no-locale';

    /** @var ResourceClientInterface */
    private $resourceClient;

    /** @var FileSystemInterface */
    private $fileSystem;

    /**
     * @param ResourceClientInterface $resourceClient
     * @param FileSystemInterface     $fileSystem
     */
    public function __construct(ResourceClientInterface $resourceClient, FileSystemInterface $fileSystem)
    {
        $this->resourceClient = $resourceClient;
        $this->fileSystem = $fileSystem;
    }

    /**
     * {@inheritdoc}
     */
    public function getFromNotLocalizableAsset($assetCode, $channelCode)
    {
        return $this->get($assetCode, $channelCode, static::NOT_LOCALIZABLE_ASSET_LOCALE_CODE);
    }

    /**
     * {@inheritdoc}
     */
    public function getFromLocalizableAsset($assetCode, $channelCode, $localeCode)
    {
        return $this->get($assetCode, $channelCode, $localeCode);
    }

    /**
     * {@inheritdoc}
     */
    public function uploadForNotLocalizableAsset($variationFile, $assetCode, $channelCode)
    {
        return $this->upload($variationFile, $assetCode, $channelCode, static::NOT_LOCALIZABLE_ASSET_LOCALE_CODE);
    }

    /**
     * {@inheritdoc}
     */
    public function uploadForLocalizableAsset($variationFile, $assetCode, $channelCode, $localeCode)
    {
        return $this->upload($variationFile, $assetCode, $channelCode, $localeCode);
    }

    /**
     * {@inheritdoc}
     */
    public function downloadFromLocalizableAsset($assetCode, $channelCode, $localeCode)
    {
        return $this->resourceClient->getStreamedResource(
            static::ASSET_VARIATION_FILE_DOWNLOAD_URI,
            [$assetCode, $channelCode, $localeCode]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function downloadFromNotLocalizableAsset($assetCode, $channelCode)
    {
        return $this->resourceClient->getStreamedResource(
            static::ASSET_VARIATION_FILE_DOWNLOAD_URI,
            [$assetCode, $channelCode, static::NOT_LOCALIZABLE_ASSET_LOCALE_CODE]
        );
    }

    /**
     * @param string $assetCode
     * @param string $channelCode
     * @param string $localeCode
     *
     * @return array
     */
    private function get($assetCode, $channelCode, $localeCode)
    {
        return $this->resourceClient->getResource(static::ASSET_VARIATION_FILE_URI, [$assetCode, $channelCode, $localeCode]);
    }

    /**
     * @param string|resource $variationFile
     * @param string          $assetCode
     * @param string          $channelCode
     * @param string          $localeCode
     *
     * @return int
     */
    private function upload($variationFile, $assetCode, $channelCode, $localeCode)
    {
        if (is_string($variationFile)) {
            $variationFile = $this->fileSystem->getResourceFromPath($variationFile);
        }

        $requestParts = [[
            'name' => 'file',
            'contents' => $variationFile,
        ]];

        $response = $this->resourceClient->createMultipartResource(
            static::ASSET_VARIATION_FILE_URI,
            [$assetCode, $channelCode, $localeCode],
            $requestParts
        );

        return $response->getStatusCode();
    }
}
