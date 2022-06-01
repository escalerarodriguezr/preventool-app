<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http\Organization\GetOrganization;

use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Application\Organization\QueryHandler\GetOrganizationByUuidQueryHandler\GetOrganizationByUuidQueryView;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\OrganizationFixtures;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetOrganizationByUuidActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/organization';

    public function setUp():void
    {
        parent::setUp();
    }

    private function prepareDataBase():void
    {
        $this->databaseTool->loadFixtures([
            UserFixtures::class,
            OrganizationFixtures::class
        ]);
    }

    public function testGetOrganization():void
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();
        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            sprintf('%s/%s',self::ENDPOINT,OrganizationFixtures::ORGANIZATION_UUID)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_OK,$response->getStatusCode());
        $responseData = json_decode($response->getContent(),true);

        self::assertEquals(OrganizationFixtures::ORGANIZATION_UUID, $responseData[GetOrganizationByUuidQueryView::UUID]);
        self::assertEquals(OrganizationFixtures::ORGANIZATION_EMAIL, $responseData[GetOrganizationByUuidQueryView::EMAIL]);
        self::assertEquals(OrganizationFixtures::ORGANIZATION_NAME, $responseData[GetOrganizationByUuidQueryView::NAME]);
        self::assertEquals(OrganizationFixtures::ORGANIZATION_LEGAL_DOCUMENT, $responseData[GetOrganizationByUuidQueryView::LEGAL_DOCUMENT]);
        self::assertEquals(OrganizationFixtures::ORGANIZATION_ADDRESS, $responseData[GetOrganizationByUuidQueryView::ADDRESS]);
        self::assertEquals(true, $responseData[GetOrganizationByUuidQueryView::IS_ACTIVE]);
        self::assertArrayHasKey(GetOrganizationByUuidQueryView::ID,$responseData);
        self::assertArrayHasKey(GetOrganizationByUuidQueryView::CREATED_ON,$responseData);
    }

    public function testGetOrganizationNotFoundException()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            \sprintf('%s/%s', self::ENDPOINT, "8ea0b2ca-4e21-4155-8bff-b87ccfba4379")
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

}