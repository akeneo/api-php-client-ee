<?php

namespace Akeneo\PimEnterprise\ApiClient\tests\Api\ReferenceEntity;

use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityApi;
use Akeneo\PimEnterprise\ApiClient\tests\Api\ApiTestCaseEnterprise;
use donatj\MockWebServer\RequestInfo;
use donatj\MockWebServer\Response;
use donatj\MockWebServer\ResponseStack;
use PHPUnit\Framework\Assert;

class UpsertListReferenceEntityIntegration extends ApiTestCaseEnterprise
{
    public function test_upsert_a_list_of_reference_entities()
    {
        $responseBody = <<<JSON
        [
          {
            "code": "brand",
            "status_code": 204
          },
          {
            "code": "designer",
            "status_code": 201
          }
        ]
JSON;

        $this->server->setResponseOfPath(
            '/'. sprintf(ReferenceEntityApi::REFERENCE_ENTITIES_URI),
            new ResponseStack(
                new Response($responseBody, [], 200)
            )
        );

        $referenceEntities = [
            [
                'code' => 'brand',
                'values' => [
                    'label' => [
                        [
                            'channel' => null,
                            'locale'  => 'en_US',
                            'data'    => 'Brand'
                        ],
                    ]
                ]
            ],
            [
                'code' => 'designer',
                'values' => [
                    'label' => [
                        [
                            'channel' => null,
                            'locale'  => 'en_US',
                            'data'    => 'Designer'
                        ],
                    ]
                ]
            ]
        ];

        $expectedResponses = [
            [
                'code' => 'brand',
                'status_code' =>204
            ],
            [
                'code' => 'designer',
                'status_code' =>201
            ],
        ];

        $api = $this->createClient()->getReferenceEntityApi();
        $responses = $api->upsertList($referenceEntities);

        Assert::assertSame($this->server->getLastRequest()->jsonSerialize()[RequestInfo::JSON_KEY_INPUT], json_encode($referenceEntities));
        Assert::assertSame($expectedResponses, $responses);
    }
}
