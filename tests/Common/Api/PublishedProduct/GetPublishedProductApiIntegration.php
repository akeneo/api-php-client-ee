<?php

namespace Akeneo\PimEnterprise\tests\Common\Api\PublishedProduct;

//TODO
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
