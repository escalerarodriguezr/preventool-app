<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http\User\SearchUser;

use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function testSearchUserByUuid()
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $queryParams = [
            'filterByUuid' => UserFixtures::ROOT_UUID,
            'pageSize' => 50,
            'currentPage' => 2,
            'orderBy' => 'email',
            'orderDirection' => 'ASC'
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT,
            $queryParams
        );

        $reponse = self::$authenticatedRootClient->getResponse();

        self::assertEquals(Response::HTTP_OK,$reponse->getStatusCode());




    }


}