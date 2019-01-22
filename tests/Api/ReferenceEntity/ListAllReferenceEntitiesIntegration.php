<?php

declare(strict_types=1);

namespace Akeneo\PimEnterprise\ApiClient\tests\Api\ReferenceEntity;

use Akeneo\PimEnterprise\ApiClient\Api\ReferenceEntityApi;
use Akeneo\PimEnterprise\ApiClient\tests\Api\ApiTestCaseEnterprise;
use donatj\MockWebServer\Response;
use donatj\MockWebServer\ResponseStack;
use PHPUnit\Framework\Assert;

class ListAllReferenceEntitiesIntegration extends ApiTestCaseEnterprise
{
    public function test_list_per_page()
    {
        $this->server->setResponseOfPath(
            '/'. sprintf(ReferenceEntityApi::REFERENCE_ENTITIES_URI),
            new ResponseStack(
                new Response($this->getFirstPage(), [], 200),
                new Response($this->getSecondPage(), [], 200)
            )
        );

        $api = $this->createClient()->getReferenceEntityApi();
        $referenceEntityCursor = $api->all();
        $referenceEntities = iterator_to_array($referenceEntityCursor);

        Assert::assertCount(3, $referenceEntities);
    }

    private function getFirstPage(): string
    {
        $baseUri = $this->server->getServerRoot();

        return <<<JSON
        {
            "_links": {
                "self": {
                    "href": "$baseUri\/api\/rest\/v1\/reference-entities"
                },
                "first": {
                    "href": "$baseUri\/api\/rest\/v1\/reference-entities"
                },
                "next": {
                    "href": "$baseUri\/api\/rest\/v1\/reference-entities?search_after=designer"
                }
            },
            "_embedded": {
                "items": [
                    {
                        "_links": {
                            "self": {
                                "href": "$baseUri\/api\/rest\/v1\/reference-entities\/brand"
                            }
                        },
                        "code": "brand",
                        "values": {
                            "label": [
                                {
                                    "locale": "en_US",
                                    "channel": null,
                                    "data": "Brand"
                                }
                            ]
                        }
                    },
                    {
                        "_links": {
                            "self": {
                                "href": "$baseUri\/api\/rest\/v1\/reference-entities\/designer"
                            }
                        },
                        "code": "designer",
                        "values": {
                            "label": [
                                {
                                    "locale": "en_US",
                                    "channel": null,
                                    "data": "Designer"
                                }
                            ]
                        }
                    }
                ]
            }
        }
JSON;

    }

    private function getSecondPage(): string
    {
        $baseUri = $this->server->getServerRoot();

        return <<<JSON
        {
            "_links": {
                "self": {
                    "href": "$baseUri\/api\/rest\/v1\/reference-entities?search_after=designr"
                },
                "first": {
                    "href": "$baseUri\/api\/rest\/v1\/reference-entities"
                }
            },
            "_embedded": {
                "items": [
                    {
                        "_links": {
                            "self": {
                                "href": "$baseUri\/api\/rest\/v1\/reference-entities\/color"
                            }
                        },
                        "code": "color",
                        "values": {
                            "label": [
                                {
                                    "locale": "en_US",
                                    "channel": null,
                                    "data": "Color"
                                }
                            ]
                        }
                    }
                ]
            }
        }
JSON;

    }
}
