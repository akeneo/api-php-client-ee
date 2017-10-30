<?php

namespace Akeneo\PimEnterprise\tests\Common\Api\PublishedProduct;

use Akeneo\Pim\Pagination\PageInterface;

//TODO
class ListPublishedProductApiIntegration extends AbstractPublishedProductApiTestCase
{
    public function testSearchHavingNoResults()
    {
        $api = $this->createClient()->getPublishedProductApi();
        $products = $api->listPerPage(10, true, [
            'search'  => [
                'name' => [
                    [
                        'operator' => '=',
                        'value'    => 'No name',
                        'locale'   => 'en_US',
                    ]
                ]
            ]
        ]);

        $this->assertInstanceOf(PageInterface::class, $products);
        $this->assertSame(0, $products->getCount());
        $this->assertEmpty($products->getItems());
    }

    /**
     * @expectedException \Akeneo\Pim\Exception\UnprocessableEntityHttpException
     */
    public function testSearchFailedWithInvalidOperator()
    {
        $api = $this->createClient()->getPublishedProductApi();
        $api->listPerPage(10, true, [
            'search'  => [
                'family' => [
                    [
                        'operator' => '=',
                        'value'    => 'Invalid operator for Family',
                    ]
                ]
            ]
        ]);
    }
}
