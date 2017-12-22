<?php

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\Pim\ApiClient\FileSystem\FileSystemInterface;

/**
 * API implementation to manage asset reference files.
 *
 * @author    Laurent Petard <laurent.petard@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class AssetReferenceFileApi implements AssetReferenceFileApiInterface
{
    const ASSET_REFERENCE_FILE_URI = '/api/rest/v1/assets/%s/reference-files/%s';

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
    public function getFromLocalizableAsset($assetCode, $localeCode)
    {
        return $this->get($assetCode, $localeCode);
    }

    /**
     * {@inheritdoc}
     */
    public function getFromNotLocalizableAsset($assetCode)
    {
        return $this->get($assetCode, 'no-locale');
    }

    /**
     * @param string $assetCode
     * @param string $localeCode
     *
     * @return array
     */
    private function get($assetCode, $localeCode)
    {
        return $this->resourceClient->getResource(static::ASSET_REFERENCE_FILE_URI, [$assetCode, $localeCode]);
    }

    /**
     * {@inheritdoc}
     */
    public function uploadForLocalizableAsset($referenceFile, $assetCode, $localeCode)
    {
        return $this->upload($referenceFile, $assetCode, $localeCode);
    }

    /**
     * {@inheritdoc}
     */
    public function uploadForNotLocalizableAsset($referenceFile, $assetCode)
    {
        return $this->upload($referenceFile, $assetCode, 'no-locale');
    }

    /**
     * @param string|resource $referenceFile
     * @param string          $assetCode
     * @param string          $localeCode
     *
     * @return int
     */
    private function upload($referenceFile, $assetCode, $localeCode)
    {
        if (is_string($referenceFile)) {
            $referenceFile = $this->fileSystem->getResourceFromPath($referenceFile);
        }

        $requestParts = [[
            'name' => 'file',
            'contents' => $referenceFile,
        ]];

        $response = $this->resourceClient->createMultipartResource(static::ASSET_REFERENCE_FILE_URI, [$assetCode, $localeCode], $requestParts);

        return $response->getStatusCode();
    }
}
