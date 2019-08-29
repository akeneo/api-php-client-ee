<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\Api;

use Akeneo\Pim\ApiClient\tests\Api\ApiTestCase;
use Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientBuilder;
use Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface;

/**
 * @author    Laurent Petard <laurent.petard@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
abstract class ApiTestCaseEnterprise extends ApiTestCase
{
    /**
     * @return AkeneoPimEnterpriseClientInterface
     */
    protected function createClient()
    {
        $clientBuilder = new AkeneoPimEnterpriseClientBuilder($this->server->getServerRoot());

        return $clientBuilder->buildAuthenticatedByPassword(
            'client_id',
            'secret',
            'username',
            'password'
        );
    }
}
