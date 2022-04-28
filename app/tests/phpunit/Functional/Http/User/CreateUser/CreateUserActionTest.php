<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http\User\CreateUser;

use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserActionTest extends FunctionalTestBase
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

    public function testCreateRootUserHttpConflict()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            'email' => 'leoanar@api.com',
            'password' => 'password123',
            'role' => User::ROLE_ROOT,
            'name' => 'Kawhi',
            'lastName' => 'Leonard'
        ];

        self::$authenticatedRootClient->request(Request::METHOD_POST,
            self::ENDPOINT,
            [],
            [],
            [],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_CONFLICT, $response->getStatusCode());

    }

    public function testCreateAdminUserHttpCreated()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();


        $payload = [
            'email' => 'brian@api.com',
            'password' => 'password123',
            'role'=>User::ROLE_ADMIN,
            'name' => 'Kawhi',
            'lastName' => 'Leonard'
        ];

        self::$authenticatedRootClient->request(Request::METHOD_POST,
            self::ENDPOINT,
            [],
            [],
            [],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

    }

    public function testCreateUserActionWithInvalidEmailHttpBadRequest()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            'email' => 'bria',
            'password' => 'password123',
            'role'=>User::ROLE_ADMIN,
            'name' => 'Kawhi',
            'lastName' => 'Leonard'
        ];

        self::$authenticatedRootClient->request(Request::METHOD_POST,
            self::ENDPOINT,
            [],
            [],
            [],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testCreateUserActionWithInvalidPasswordHttpBadRequest()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            'email' => 'brian@api.com',
            'password' => 'pa',
            'role'=>User::ROLE_ADMIN,
            'name' => 'Kawhi',
            'lastName' => 'Leonard'
        ];

        self::$authenticatedRootClient->request(Request::METHOD_POST,
            self::ENDPOINT,
            [],
            [],
            [],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testCreateUserActionWithInvalidRoleHttpBadRequest()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            'email' => 'brian@api.com',
            'password' => 'password123',
            'role'=>'FAKE_ROLE',
            'name' => 'Kawhi',
            'lastName' => 'Leonard'
        ];

        self::$authenticatedRootClient->request(Request::METHOD_POST,
            self::ENDPOINT,
            [],
            [],
            [],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testCreateUserActionWithEmailAlreadyRegisterHttpConflict()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            'email' => UserFixtures::FRODO_EMAIL,
            'password' => UserFixtures::FRODO_PASSWORD,
            'role'=>UserFixtures::FRODO_ROLE,
            'name' => 'Kawhi',
            'lastName' => 'Leonard'
        ];

        self::$authenticatedRootClient->request(Request::METHOD_POST,
            self::ENDPOINT,
            [],
            [],
            [],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_CONFLICT, $response->getStatusCode());
    }

    public function testCreateAdminUserWithInvalidNameHttpBadRequest()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            'email' => 'brian@api.com',
            'password' => 'password123',
            'role'=>User::ROLE_ADMIN,
            'name' => '',
            'lastName' => 'Leonard'
        ];

        self::$authenticatedRootClient->request(Request::METHOD_POST,
            self::ENDPOINT,
            [],
            [],
            [],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());

    }

    public function testCreateAdminUserWithInvalidLastNameHttpBadRequest()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            'email' => 'brian@api.com',
            'password' => 'password123',
            'role'=>User::ROLE_ADMIN,
            'name' => 'Kawi',
            'lastName' => ''
        ];

        self::$authenticatedRootClient->request(Request::METHOD_POST,
            self::ENDPOINT,
            [],
            [],
            [],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

}