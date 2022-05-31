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
        self::assertGreaterThan(1,count($organizations));
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

    public function testWithActionRootUseEmptyArrayResult():void
    {
        $this->prepareDatabase();;
        $this->getAuthenticatedRootClient();

        $queryParams = [
            'filterByEmail' => "empty-not-found987635@email.com"
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT,
            $queryParams
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
        self::assertEquals(0,count($organizations));
    }

    public function testWithActionRootUserFilterByUuid():void
    {
        $this->prepareDatabase();;
        $this->getAuthenticatedRootClient();

        $queryParams = [
            'filterByUuid' => OrganizationFixtures::TRAVIMUS_UUID
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT,
            $queryParams
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
        self::assertEquals(1,count($organizations));
        $firstOrganization = $organizations[0];

        self::assertIsArray($firstOrganization);
        self::assertArrayHasKey('uuid',$firstOrganization);
        self::assertEquals($firstOrganization['uuid'],OrganizationFixtures::TRAVIMUS_UUID);
    }

    public function testWithActionRootUserFilterByEmail():void
    {
        $this->prepareDatabase();;
        $this->getAuthenticatedRootClient();

        $queryParams = [
            'filterByEmail' => OrganizationFixtures::TRAVIMUS_EMAIL
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT,
            $queryParams
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
        self::assertEquals(1,count($organizations));
        $firstOrganization = $organizations[0];

        self::assertIsArray($firstOrganization);
        self::assertArrayHasKey('email',$firstOrganization);
        self::assertEquals($firstOrganization['email'],OrganizationFixtures::TRAVIMUS_EMAIL);
    }

    public function testWithActionRootUserFilterByIsActiveTrue():void
    {
        $this->prepareDatabase();;
        $this->getAuthenticatedRootClient();

        $queryParams = [
            'filterByIsActive' => true
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT,
            $queryParams
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
        self::assertEquals(2,count($organizations));

    }

    public function testWithActionRootUserFilterByIsActiveFalse():void
    {
        $this->prepareDatabase();;
        $this->getAuthenticatedRootClient();

        $queryParams = [
            'filterByIsActive' => 'false'
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT,
            $queryParams
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
        self::assertEquals(0,count($organizations));

    }

}