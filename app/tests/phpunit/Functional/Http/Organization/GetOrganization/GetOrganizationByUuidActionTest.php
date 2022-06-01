<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http\Organization\GetOrganization;

use phpDocumentor\Reflection\Types\Void_;
use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
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
        $this->getAuthenticatedRootClient();
        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            sprintf('%s/%s',self::ENDPOINT,OrganizationFixtures::ORGANIZATION_UUID)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_OK,$response->getStatusCode());

    }


}