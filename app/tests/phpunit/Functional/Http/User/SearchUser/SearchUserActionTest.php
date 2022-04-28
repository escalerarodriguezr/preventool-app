<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http\User\SearchUser;

use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Symfony\Component\HttpFoundation\Request;

class SearchUserActionTest extends FunctionalTestBase
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

    public function testSearchAll()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT,
        );

        $response = self::$authenticatedRootClient->getResponse();
        $responseData = \json_decode($response->getContent(), true);

        self::assertArrayHasKey('total', $responseData);
        self::assertArrayHasKey('pages', $responseData);
        self::assertArrayHasKey('currentPage', $responseData);

        self::assertArrayHasKey('items', $responseData);
        $users = $responseData['items'];
        self::assertIsArray($users);
        self::assertGreaterThan(1,count($users));
        $firstUser = $users[0];
        self::assertIsArray($firstUser);
        self::assertArrayHasKey('id',$firstUser);
        self::assertArrayHasKey('uuid',$firstUser);
        self::assertArrayHasKey('name',$firstUser);
        self::assertArrayHasKey('lastName',$firstUser);
        self::assertArrayHasKey('email',$firstUser);
        self::assertArrayHasKey('createdOn',$firstUser);
        self::assertArrayHasKey('updatedOn',$firstUser);
        self::assertArrayHasKey('role',$firstUser);
        self::assertArrayHasKey('isEmailConfirmed',$firstUser);
        self::assertArrayHasKey('isActive',$firstUser);
    }

    public function testSearchEmptyArrayResult()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $queryParams = [
            'filterByEmail' => "empty-not-found987635@email.com",
        ];


        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT,
            $queryParams
        );

        $response = self::$authenticatedRootClient->getResponse();
        $responseData = \json_decode($response->getContent(), true);

        self::assertArrayHasKey('total', $responseData);
        self::assertArrayHasKey('pages', $responseData);
        self::assertArrayHasKey('currentPage', $responseData);

        self::assertEquals(0,$responseData['total']);
        self::assertArrayHasKey('items', $responseData);
        $users = $responseData['items'];
        self::assertIsArray($users);
        self::assertEquals(0,count($users));
    }

    public function testSearchUserByUuid()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $queryParams = [
            'filterByEmail' => UserFixtures::ROOT_EMAIL,
            'pageSize' => 50,
            'currentPage' => 1,
            'orderBy' => 'email',
            'orderDirection' => 'ASC'
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT,
            $queryParams
        );

        $response = self::$authenticatedRootClient->getResponse();
        $responseData = \json_decode($response->getContent(), true);

        self::assertArrayHasKey('total', $responseData);
        self::assertArrayHasKey('pages', $responseData);
        self::assertArrayHasKey('currentPage', $responseData);
        self::assertArrayHasKey('items', $responseData);

        $users = $responseData['items'];
        self::assertIsArray($users);
        self::assertEquals(1,count($users));
    }

    public function testSearchUserFilterByIsActive()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $queryParams = [
            'filterByIsActive' => true,
            'pageSize' => 50,
            'currentPage' => 1,
            'orderBy' => 'email',
            'orderDirection' => 'ASC'
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT,
            $queryParams
        );

        $response = self::$authenticatedRootClient->getResponse();
        $responseData = \json_decode($response->getContent(), true);

        self::assertArrayHasKey('total', $responseData);
        self::assertArrayHasKey('pages', $responseData);
        self::assertArrayHasKey('currentPage', $responseData);
        self::assertArrayHasKey('items', $responseData);
        $users = $responseData['items'];
        self::assertIsArray($users);
        self::assertGreaterThan(0,count($users));
    }

    public function testSearchUserFilterByIsNotActive()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $queryParams = [
            'filterByIsActive' => 'false',
            'pageSize' => 50,
            'currentPage' => 1,
            'orderBy' => 'email',
            'orderDirection' => 'ASC'
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT,
            $queryParams
        );

        $response = self::$authenticatedRootClient->getResponse();
        $responseData = \json_decode($response->getContent(), true);

        self::assertEquals(0,$responseData['total']);
    }
}