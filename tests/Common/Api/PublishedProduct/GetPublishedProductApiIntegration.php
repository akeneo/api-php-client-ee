<?php

namespace Akeneo\PimEnterprise\tests\Common\Api\PublishedProduct;

class GetPublishedProductApiIntegration extends AbstractPublishedProductApiTestCase
{
//    public function testGet()
//    {
//        //TODO
//    }

    /**
     * @expectedException \Akeneo\Pim\Exception\NotFoundHttpException
     */
    public function testGetNotFound()
    {
        $api = $this->createClient()->getPublishedProductApi();

        $api->get('pumps');
    }
}
