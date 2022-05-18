<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http\User\UpdateUser;

use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Preventool\Infrastructure\Ui\Http\Request\DTO\User\UpdateUserRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserActionTest extends FunctionalTestBase
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

    public function testUpdateRootUserNameLastNameEmailByRootUserRoleSuccessResponse()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            UpdateUserRequest::NAME => 'Kawhi',
            UpdateUserRequest::LASTNAME => 'Leonard',
            UpdateUserRequest::EMAIL => 'leonard@leonard.com'
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_PUT,
            sprintf('%s/%s',self::ENDPOINT,UserFixtures::ROOT_UUID),
            [],[],[],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_OK,$response->getStatusCode());
    }

    public function testUpdateRootUserErrorInputNameLastNameEmailByRootUserRoleBadRequestResponse()
    {

        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            UpdateUserRequest::NAME => '',
            UpdateUserRequest::LASTNAME => 'Leonard',
            UpdateUserRequest::EMAIL => 'leonard@leonard.com',
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_PUT,
            sprintf('%s/%s',self::ENDPOINT,UserFixtures::ROOT_UUID),
            [],[],[],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST,$response->getStatusCode());
    }

    public function testUpdateRootUserNameErrorInputLastNameEmailByRootUserRoleBadRequestResponse()
    {

        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            UpdateUserRequest::NAME => 'Kawai',
            UpdateUserRequest::LASTNAME => '',
            UpdateUserRequest::EMAIL => 'leonard@leonard.com',
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_PUT,
            sprintf('%s/%s',self::ENDPOINT,UserFixtures::ROOT_UUID),
            [],[],[],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST,$response->getStatusCode());
    }

    public function testUpdateRootUserNameLastNameErrorInputEmailByRootUserRoleBadRequestResponse()
    {

        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            UpdateUserRequest::NAME => 'Kawhi',
            UpdateUserRequest::LASTNAME => 'Leonard',
            UpdateUserRequest::EMAIL => 'leonar',
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_PUT,
            sprintf('%s/%s',self::ENDPOINT,UserFixtures::ROOT_UUID),
            [],[],[],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST,$response->getStatusCode());
    }

    public function testUpdateAdminUserByRootUserRoleSuccessResponse()
    {

        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            UpdateUserRequest::NAME => 'Kawhi',
            UpdateUserRequest::LASTNAME => 'Leonard',
            UpdateUserRequest::EMAIL => 'leonard@leonard.com',
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_PUT,
            sprintf('%s/%s',self::ENDPOINT,UserFixtures::FRODO_UUID),
            [],[],[],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_OK,$response->getStatusCode());
    }


    public function testUpdateRootUserByAdminUserRoleConflictResponse()
    {

        $this->prepareDataBase();

        $this->getAuthenticatedAdminFrodoClient();

        $payload = [
            UpdateUserRequest::NAME => 'Kawhi',
            UpdateUserRequest::LASTNAME => 'Leonard',
            UpdateUserRequest::EMAIL => 'leonar@leonard.com',
        ];

        self::$authenticatedAdminFrodoClient->request(
            Request::METHOD_PUT,
            sprintf('%s/%s',self::ENDPOINT,UserFixtures::ROOT_UUID),
            [],[],[],
            \json_encode($payload)
        );

        $response = self::$authenticatedAdminFrodoClient->getResponse();




        self::assertEquals(Response::HTTP_CONFLICT,$response->getStatusCode());
    }

    public function testUpdateRootUserByAnotherRootUserBadRequestResponse()
    {

        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            UpdateUserRequest::NAME => 'Kawhi',
            UpdateUserRequest::LASTNAME => 'Leonard',
            UpdateUserRequest::EMAIL => 'leonar@leonard.com',
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_PUT,
            sprintf('%s/%s',self::ENDPOINT,UserFixtures::ROOT_2_UUID),
            [],[],[],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_CONFLICT,$response->getStatusCode());
    }

    public function testUpdateAdminUserByAnotherAdminUserBadRequestResponse()
    {

        $this->prepareDataBase();
        $this->getAuthenticatedAdminFrodoClient();

        $payload = [
            UpdateUserRequest::NAME => 'Kawhi',
            UpdateUserRequest::LASTNAME => 'Leonard',
            UpdateUserRequest::EMAIL => 'leonar@leonard.com',
        ];

        self::$authenticatedAdminFrodoClient->request(
            Request::METHOD_PUT,
            sprintf('%s/%s',self::ENDPOINT,UserFixtures::FRODO_2_UUID),
            [],[],[],
            \json_encode($payload)
        );

        $response = self::$authenticatedAdminFrodoClient->getResponse();
        self::assertEquals(Response::HTTP_CONFLICT,$response->getStatusCode());
    }

    public function testUpdateAdminUserFieldsIsActiveAndRoleByRootUserRoleSuccessResponse()
    {

        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            UpdateUserRequest::IS_ACTIVE => false,
            UpdateUserRequest::ROLE => User::ROLE_ROOT
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_PUT,
            sprintf('%s/%s',self::ENDPOINT,UserFixtures::FRODO_UUID),
            [],[],[],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_OK,$response->getStatusCode());
    }

    public function testCanNotDeactivateItselfActionUserActionNotAllowedExceptionResponse()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedAdminFrodoClient();

        $payload = [
            UpdateUserRequest::IS_ACTIVE => false,
        ];

        self::$authenticatedAdminFrodoClient->request(
            Request::METHOD_PUT,
            sprintf('%s/%s',self::ENDPOINT,UserFixtures::FRODO_UUID),
            [],[],[],
            \json_encode($payload)
        );

        $response = self::$authenticatedAdminFrodoClient->getResponse();
        self::assertEquals(Response::HTTP_CONFLICT,$response->getStatusCode());
    }
}