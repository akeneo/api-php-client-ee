<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\Common\Api;

use Akeneo\Pim\ApiClient\tests\Common\Api\ApiTestCase as BaseApiTestCase;
use Akeneo\Pim\ApiClient\tests\CredentialGenerator;
use Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientBuilder;
use Akeneo\PimEnterprise\ApiClient\AkeneoPimEnterpriseClientInterface;

/**
 * @author    Olivier Soulet <olivier.soulet@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
abstract class ApiTestCase extends BaseApiTestCase
{
    /**
     * @param string $username
     * @param string $password
     *
     * @return AkeneoPimEnterpriseClientInterface
     */
    protected function createClient($username = 'admin', $password = 'admin')
    {
        $config = $this->getConfiguration();
        $generator = new CredentialGenerator($this->getCommandLauncher());

        $credentials = $generator->generate($config['pim']['version']);
        $clientBuilder = new AkeneoPimEnterpriseClientBuilder($config['pim']['base_uri']);

        return $clientBuilder->buildAuthenticatedByPassword(
            $credentials['client_id'],
            $credentials['secret'],
            $username,
            $password
        );
    }

    /**
     * @return string
     */
    protected function getConfigurationFile()
    {
        return realpath(dirname(__FILE__)).'/../../../tests/etc/parameters.yml';
    }
}
