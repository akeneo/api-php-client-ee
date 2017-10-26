<?php

namespace Akeneo\PimEnterprise\tests\Common\Api;

use Akeneo\Pim\tests\Common\Api\ApiTestCase as BaseApiTestCase;
use Akeneo\Pim\tests\DockerCredentialGenerator;
use Akeneo\Pim\tests\LocalCredentialGenerator;
use Akeneo\PimEnterprise\AkeneoPimEnterpriseClientBuilder;
use Akeneo\PimEnterprise\AkeneoPimEnterpriseClientInterface;

/**
 * @author    Olivier Soulet <olivier.soulet@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
abstract class ApiTestCase extends BaseApiTestCase
{
    /**
     * @return AkeneoPimEnterpriseClientInterface
     */
    protected function createClient()
    {
        $config = $this->getConfiguration();
        $generator = new LocalCredentialGenerator();
        if (true === $config['pim']['is_docker']) {
            $generator = new DockerCredentialGenerator($config['pim']['docker_name']);
        }

        $credentials = $generator->generate($config['pim']['install_path'], $config['pim']['bin_path'], $config['pim']['version']);
        $clientBuilder = new AkeneoPimEnterpriseClientBuilder($config['api']['baseUri']);

        return $clientBuilder->buildAuthenticatedByPassword(
            $credentials['client_id'],
            $credentials['secret'],
            $config['api']['credentials']['username'],
            $config['api']['credentials']['password']
        );
    }
}
