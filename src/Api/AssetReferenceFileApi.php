<?php

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Client\ResourceClientInterface;
use Akeneo\Pim\ApiClient\FileSystem\FileSystemInterface;
use Akeneo\PimEnterprise\ApiClient\Exception\UploadAssetReferenceFileErrorException;
use Psr\Http\Message\ResponseInterface;

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
    const ASSET_REFERENCE_FILE_DOWNLOAD_URI = '/api/rest/v1/assets/%s/reference-files/%s/download';
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
    public function getFromLocalizableAsset($assetCode, $localeCode)
    {
        return $this->get($assetCode, $localeCode);
    }

    /**
     * {@inheritdoc}
     */
    public function getFromNotLocalizableAsset($assetCode)
    {
        return $this->get($assetCode, static::NOT_LOCALIZABLE_ASSET_LOCALE_CODE);
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
        return $this->upload($referenceFile, $assetCode, static::NOT_LOCALIZABLE_ASSET_LOCALE_CODE);
    }

    /**
     * {@inheritdoc}
     */
    public function downloadFromLocalizableAsset($assetCode, $localeCode)
    {
        return $this->resourceClient
            ->getStreamedResource(static::ASSET_REFERENCE_FILE_DOWNLOAD_URI, [$assetCode, $localeCode])
            ->getBody();
    }

    /**
     * {@inheritdoc}
     */
    public function downloadFromNotLocalizableAsset($assetCode)
    {
        return $this->resourceClient
            ->getStreamedResource(static::ASSET_REFERENCE_FILE_DOWNLOAD_URI, [$assetCode, static::NOT_LOCALIZABLE_ASSET_LOCALE_CODE])
            ->getBody();
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
        $this->handleUploadErrors($response);

        return $response->getStatusCode();
    }

    /**
     * @param ResponseInterface $response
     *
     * @throws UploadAssetReferenceFileErrorException if an upload returns any errors.
     */
    private function handleUploadErrors(ResponseInterface $response)
    {
        $decodedResponse = json_decode($response->getBody()->getContents(), true);
        $errors = isset($decodedResponse['errors']) ? $decodedResponse['errors'] : null;

        if (is_array($errors) && !empty($errors)) {
            $message = isset($decodedResponse['message']) ? $decodedResponse['message'] : 'Errors occurred during the upload.';

            throw new UploadAssetReferenceFileErrorException($message, $errors);
        }
    }
}
