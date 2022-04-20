<?php

namespace PHPUnit\Tests\Functional\Http\User\GetUser;

use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetUserByUuidActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/user';

    public function setUp():void
    {
        parent::setUp();
    }

    private function prepareDataBase():void
    {
        $this->databaseTool->loadFixtures([
            UserFixtures::class
        ]);
    }

    public function testGetFrodoByUuid()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            \sprintf('%s/%s', self::ENDPOINT, UserFixtures::FRODO_UUID)
        );

        $response = self::$authenticatedRootClient->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);

        self::assertEquals(UserFixtures::FRODO_UUID, $responseData['uuid']);
        self::assertEquals(UserFixtures::FRODO_EMAIL, $responseData['email']);
        self::assertEquals(UserFixtures::FRODO_NAME, $responseData['name']);
        self::assertEquals(UserFixtures::FRODO_LASTNAME, $responseData['lastName']);
        self::assertEquals(UserFixtures::FRODO_ROLE, $responseData['role']);
        self::assertEquals(true, $responseData['isActive']);
        self::assertEquals(true, $responseData['isEmailConfirmed']);
        self::assertArrayHasKey('id',$responseData);
        self::assertArrayHasKey('creatorUuid',$responseData);
        self::assertArrayHasKey('createdOn',$responseData);

    }

    public function testGetUserNotFoundException()
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