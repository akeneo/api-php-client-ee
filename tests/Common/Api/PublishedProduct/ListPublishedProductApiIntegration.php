<?php

namespace Akeneo\PimEnterprise\tests\Common\Api\PublishedProduct;

use Akeneo\Pim\Pagination\PageInterface;

/**
 * @author    Olivier Soulet <olivier.soulet@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
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
