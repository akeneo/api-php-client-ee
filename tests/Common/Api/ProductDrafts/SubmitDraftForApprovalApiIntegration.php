<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\Common\Api\ProductDrafts;

/**
 * @author    Damien Carcel <damien.carcel@gmail.com>
 * @copyright 2017 Akeneo SAS (http=>//www.akeneo.com)
 * @license   http=>//opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class SubmitDraftForApprovalApiIntegration extends AbstractProductDraftApiTestCase
{
    public function testSubmitForApproval()
    {
        $client = $this->createClient('Sandra', 'Sandra');

        $client->getProductApi()->upsert('big_boot', [
            'values' => [
                'name' => [
                    [
                        'data' => 'A new name to create a draft',
                        'locale' => 'en_US',
                        'scope' => null,
                    ],
                ],
            ],
        ]);

        $response = $client->getProductDraftApi()->submitForApproval('big_boot');

        $this->assertSame(201, $response);
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\NotFoundHttpException
     * @expectedExceptionMessage Product "ham" does not exist
     */
    public function testSubmitNonExistingDraft()
    {
        $api = $this->createClient('Sandra', 'Sandra')->getProductDraftApi();

        $api->submitForApproval('ham');
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\UnprocessableEntityHttpException
     * @expectedExceptionMessage You should create a draft before submitting it for approval.
     */
    public function testSubmitNotOwnedDraft()
    {
        $productApi = $this->createClient('Sandra', 'Sandra')->getProductApi();
        $productApi->upsert('big_boot', [
            'values' => [
                'name' => [
                    [
                        'data' => 'A new name to create a draft',
                        'locale' => 'en_US',
                        'scope' => null,
                    ],
                ],
            ],
        ]);

        $proposalApi = $this->createClient('Mary', 'Mary')->getProductDraftApi();
        $proposalApi->submitForApproval('big_boot');
    }
}
