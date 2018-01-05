<?php

namespace Akeneo\PimEnterprise\ApiClient\Api;

/**
 * API to manage asset reference files.
 *
 * @author    Laurent Petard <laurent.petard@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
interface AssetReferenceFileApiInterface
{
    /**
     * Available since Akeneo PIM 2.1.
     * Gets an asset reference file by its asset code and local code for a localizable asset.
     *
     * @param string $assetCode  code of the asset
     * @param string $localeCode code of the locale
     *
     * @throws HttpException If the request failed
     *
     * @return array
     */
    public function getFromLocalizableAsset($assetCode, $localeCode);

    /**
     * Available since Akeneo PIM 2.1.
     * Gets an asset reference file by its asset code for a not localizable asset.
     *
     * @param string $assetCode code of the asset
     *
     * @throws HttpException If the request failed
     *
     * @return array
     */
    public function getFromNotLocalizableAsset($assetCode);

    /**
     * Available since Akeneo PIM 2.1.
     * Uploads a new reference file for a given localizable asset and locale.
     * It will also automatically generate all the variation files corresponding to this reference file.
     *
     * @param string          $assetCode     code of the asset
     * @param string          $localeCode    code of the locale
     * @param string|resource $referenceFile file path or resource of the reference file to upload
     *
     * @throws HttpException If the request failed
     *
     * @return int Status code 201 indicating that the asset reference file has been well uploaded
     */
    public function uploadForLocalizableAsset($referenceFile, $assetCode, $localeCode);

    /**
     * Available since Akeneo PIM 2.1.
     * Uploads a new reference file for a given not localizable asset.
     * It will also automatically generate all the variation files corresponding to this reference file.
     *
     * @param string          $assetCode     code of the asset
     * @param string|resource $referenceFile file path or resource of the reference file to upload
     *
     * @throws HttpException If the request failed
     *
     * @return int Status code 201 indicating that the asset reference file has been well uploaded
     */
    public function uploadForNotLocalizableAsset($referenceFile, $assetCode);
}
