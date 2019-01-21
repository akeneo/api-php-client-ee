<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\Api;

use Akeneo\Pim\ApiClient\Api\Operation\DownloadableResourceInterface;
use Akeneo\Pim\ApiClient\Exception\HttpException;
use Akeneo\Pim\ApiClient\Exception\RuntimeException;

/**
 * @author    Laurent Petard <laurent.petard@akeneo.com>
 * @copyright 2018 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
interface ReferenceEntityMediaFileApiInterface extends DownloadableResourceInterface
{
    /**
     * Creates a new reference entity media file.
     *
     * @param string|resource $mediaFile File path or resource of the media file
     *
     * @throws HttpException    If the request failed.
     * @throws RuntimeException If the file could not be opened.
     *
     * @return string returns the code of the created media file
     */
    public function create($mediaFile): string;
}
