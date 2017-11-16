<?php

namespace Akeneo\PimEnterprise\tests\Common\Api\ProductDrafts;

/**
 * @author    Damien Carcel <damien.carcel@gmail.com>
 * @copyright 2017 Akeneo SAS (http=>//www.akeneo.com)
 * @license   http=>//opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class GetProductDraftApiIntegration extends AbstractProductDraftApiTestCase
{
    /**
     * @expectedException \Akeneo\Pim\Exception\NotFoundHttpException
     */
    public function testGetNotFound()
    {
        $api = $this->createClient()->getProductDraftApi();

        $api->get('ham');
    }

    public function testGet()
    {
        $this->createDraft(
            'big_boot',
            [
                [
                    'type' => 'set_data',
                    'field' => 'name',
                    'data' => 'My new name, just for this draft',
                    'locale' => 'en_US',
                ],
            ],
            'Sandra'
        );

        $expectedProductDraft = [
            'identifier' => 'big_boot',
            'family' => 'boots',
            'parent' => null,
            'groups' => [
                'similar_boots',
            ],
            'categories' => [
                'summer_collection',
                'winter_boots',
                'winter_collection',
            ],
            'enabled' => true,
            'values' => [
                'size' => [
                    [
                        'locale' => null,
                        'scope' => null,
                        'data' => '37',
                    ],
                ],
                'color' => [
                    [
                        'locale' => null,
                        'scope' => null,
                        'data' => 'black',
                    ],
                ],
                'price' => [
                    [
                        'locale' => null,
                        'scope' => null,
                        'data' => [
                            [
                                'amount' => '120.00',
                                'currency' => 'EUR',
                            ],
                            [
                                'amount' => '110.00',
                                'currency' => 'USD',
                            ],
                        ],
                    ],
                ],
                'side_view' => [
                    [
                        'locale' => null,
                        'scope' => null,
                        'data' => 'this is a media identifier',
                        '_links' => [
                            'download' => [
                                'href' => 'this is a media identifier',
                            ],
                        ],
                    ],
                ],
                'description' => [
                    [
                        'locale' => 'en_US',
                        'scope' => 'ecommerce',
                        'data' => 'Big boot for a big foot.',
                    ],
                ],
                'manufacturer' => [
                    [
                        'locale' => null,
                        'scope' => null,
                        'data' => 'TimberLand',
                    ],
                ],
                'weather_conditions' => [
                    [
                        'locale' => null,
                        'scope' => null,
                        'data' => [
                            'dry',
                            'wet',
                        ],
                    ],
                ],
                'name' => [
                    [
                        'locale' => 'en_US',
                        'scope' => null,
                        'data' => 'My new name, just for this draft',
                    ],
                ],
            ],
            'created' => 'this is a date formatted to ISO-8601',
            'updated' => 'this is a date formatted to ISO-8601',
            'associations' => [
                'PACK' => [
                    'groups' => [],
                    'products' => [],
                ],
                'SUBSTITUTION' => [
                    'groups' => [],
                    'products' => [],
                ],
                'UPSELL' => [
                    'groups' => [],
                    'products' => [],
                ],
                'X_SELL' => [
                    'groups' => [],
                    'products' => [
                        'small_boot',
                        'medium_boot',
                    ],
                ],
            ],
            'metadata' => [
                'workflow_status' => 'draft_in_progress',
            ],
        ];

        $api = $this->createClient('Sandra', 'Sandra')->getProductDraftApi();
        $productDraft = $api->get('big_boot');
        $sanitizedProductDraft = $this->sanitizeProductDraftData($productDraft);

        $this->assertSame($expectedProductDraft, $sanitizedProductDraft);
    }

    /**
     * @expectedException \Akeneo\Pim\Exception\NotFoundHttpException
     */
    public function testCannotGetIfNoRightAccess()
    {
        $this->createDraft(
            'big_boot',
            [
                [
                    'type' => 'set_data',
                    'field' => 'name',
                    'data' => 'My new name, just for this draft',
                    'locale' => 'en_US',
                ],
            ],
            'Sandra'
        );

        $api = $this->createClient('Mary', 'Mary')->getProductDraftApi();
        $api->get('big_boot');
    }
}
