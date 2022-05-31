<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http\Organization\SearchOrganization;

use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\OrganizationFixtures;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchOrganizationActionTest extends FunctionalTestBase
{
    private const ENDPOINT = 'api/v1/organization';

    public function setUp():void
    {
        parent::setUp();
    }

    private function prepareDatabase():void
    {
        $this->databaseTool->loadFixtures([
            UserFixtures::class,
            OrganizationFixtures::class
        ]);
    }

    public function testWithActionRootUserSearchAll():void
    {
        $this->prepareDatabase();;
        $this->getAuthenticatedRootClient();

        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_OK,$response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);

        self::assertArrayHasKey('total', $responseData);
        self::assertArrayHasKey('pages', $responseData);
        self::assertArrayHasKey('currentPage', $responseData);

        self::assertArrayHasKey('items', $responseData);
        $organizations = $responseData['items'];
        self::assertIsArray($organizations);
        self::assertGreaterThan(0,count($organizations));
        $firstOrganization = $organizations[0];
        self::assertIsArray($firstOrganization);
        self::assertArrayHasKey('id',$firstOrganization);
        self::assertArrayHasKey('uuid',$firstOrganization);
        self::assertArrayHasKey('name',$firstOrganization);
        self::assertArrayHasKey('email',$firstOrganization);
        self::assertArrayHasKey('createdOn',$firstOrganization);
        self::assertArrayHasKey('updatedOn',$firstOrganization);
        self::assertArrayHasKey('legalDocument',$firstOrganization);
        self::assertArrayHasKey('address',$firstOrganization);
        self::assertArrayHasKey('isActive',$firstOrganization);

    }


}