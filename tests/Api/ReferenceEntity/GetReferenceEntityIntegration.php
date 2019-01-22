<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\tests\Api\ReferenceEntity;

use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityApi;
use Akeneo\PimEnterprise\ApiClient\tests\Api\ApiTestCaseEnterprise;
use donatj\MockWebServer\RequestInfo;
use donatj\MockWebServer\Response;
use donatj\MockWebServer\ResponseStack;
use PHPUnit\Framework\Assert;

class GetReferenceEntityIntegration extends ApiTestCaseEnterprise
{
    public function test_get_reference_entity()
    {
        $this->server->setResponseOfPath(
            '/'. sprintf(ReferenceEntityApi::REFERENCE_ENTITY_URI, 'brand'),
            new ResponseStack(
                new Response($this->getBrand(), [], 200)
            )
        );

        $api = $this->createClient()->getReferenceEntityApi();
        $product = $api->get('brand');

        Assert::assertSame($this->server->getLastRequest()->jsonSerialize()[RequestInfo::JSON_KEY_METHOD], 'GET');
        Assert::assertEquals($product, json_decode($this->getBrand(), true));
    }

    /**
     * @expectedExceptionMessage  Reference entity "foo" does not exist.
     */
    public function test_get_unknown_reference_entity()
    {
        $this->server->setResponseOfPath(
            '/'. sprintf(ReferenceEntityApi::REFERENCE_ENTITY_URI, 'designer', 'foo'),
            new ResponseStack(
                new Response('{"code": 404, "message":"Reference entity \"foo\" does not exist."}', [], 404)
            )
        );

        $api = $this->createClient()->getReferenceEntityApi();
        $api->get('foo');
    }

    private function getBrand(): string
    {
        return <<<JSON
            {
              "code": "brand",
              "labels": {
                "en_US": "Brand"
              }
            }
JSON;
    }
}
