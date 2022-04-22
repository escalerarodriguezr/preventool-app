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

    public function testUpdateRootUserNameAndLastnameByRootUserRoleSuccessResponse()
    {

        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            UpdateUserRequest::NAME => 'Kawhi',
            UpdateUserRequest::LASTNAME => 'Leonard',
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

}