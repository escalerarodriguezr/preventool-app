<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http\Organization\CreateOrganization;

use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
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
            UserFixtures::class
        ]);
    }

    public function testCreateOrganizationRootActionUserSuccessRespose():void
    {
        $this->prepareDatabase();
        $this->getAuthenticatedRootClient();

        $payload = [

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


}