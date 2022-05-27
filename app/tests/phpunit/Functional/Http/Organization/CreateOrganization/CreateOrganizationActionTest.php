<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http\Organization\CreateOrganization;

use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\OrganizationFixtures;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateOrganizationActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/organization';

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

    public function testCreateOrganizationByRootActionUserEmailBadRequestExceptionResponse():void
    {
        $this->prepareDatabase();
        $this->getAuthenticatedRootClient();

        $payload = [
            'email' => 'info',
            'name' => 'Setelsa',
            'legalDocument' => '0000000X',
            'address' => 'Setelsa example address'
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_POST,
            self::ENDPOINT,
            [],[],[],
            json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST,$response->getStatusCode());
    }

    public function testCreateOrganizationByRootActionUserNameBadRequestExceptionResponse():void
    {
        $this->prepareDatabase();
        $this->getAuthenticatedRootClient();

        $payload = [
            'email' => 'info@info.com',
            'name' => ' ',
            'legalDocument' => '0000000X',
            'address' => 'Setelsa example address'
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_POST,
            self::ENDPOINT,
            [],[],[],
            json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST,$response->getStatusCode());
    }

    public function testCreateOrganizationByRootActionUserSuccessRespose():void
    {

        $this->prepareDatabase();
        $this->getAuthenticatedRootClient();

        $payload = [
            'email' => 'info@organization.com',
            'name' => 'Setelsa',
            'legalDocument' => '0000000X',
            'address' => 'Setelsa example address'
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_POST,
            self::ENDPOINT,
            [],[],[],
            json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_CREATED,$response->getStatusCode());
    }


    public function testCreateOrganizationByRootActionUserOrganizationAlreadyExistsResponse():void
    {
        $this->prepareDatabase();
        $this->getAuthenticatedRootClient();

        $payload = [
            'email' => OrganizationFixtures::ORGANIZATION_EMAIL,
            'name' => OrganizationFixtures::ORGANIZATION_NAME,
            'legalDocument' => OrganizationFixtures::ORGANIZATION_LEGAL_DOCUMENT,
            'address' => OrganizationFixtures::ORGANIZATION_ADDRESS
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_POST,
            self::ENDPOINT,
            [],[],[],
            json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
       
        self::assertEquals(Response::HTTP_CONFLICT,$response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertStringContainsString("OrganizationAlreadyExistsException", $responseData['class']);
    }

    public function testCreateOrganizationByAdminActionUserOrganizationActionNotAllowedExceptionResponse():void
    {
        $this->prepareDatabase();
        $this->getAuthenticatedAdminFrodoClient();

        $payload = [
            'email' => 'info@organization.com',
            'name' => 'Setelsa',
            'legalDocument' => '0000000X',
            'address' => 'Setelsa example address'
        ];

        self::$authenticatedAdminFrodoClient->request(
            Request::METHOD_POST,
            self::ENDPOINT,
            [],[],[],
            json_encode($payload)
        );

        $response = self::$authenticatedAdminFrodoClient->getResponse();

        self::assertEquals(Response::HTTP_CONFLICT,$response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertStringContainsString("ActionUserActionNotAllowedException", $responseData['class']);
    }

}