<?php

namespace Akeneo\PimEnterprise\tests\Common\Api\PublishedProduct;

/**
 * @author    Olivier Soulet <olivier.soulet@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class GetPublishedProductApiIntegration extends AbstractPublishedProductApiTestCase
{
    /**
     * @expectedException \Akeneo\Pim\Exception\NotFoundHttpException
     */
    public function testGetNotFound()
    {
        $api = $this->createClient()->getPublishedProductApi();

        $api->get('pumps');
    }
}
