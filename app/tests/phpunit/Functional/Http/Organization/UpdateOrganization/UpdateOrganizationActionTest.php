<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http\Organization\UpdateOrganization;

use phpDocumentor\Reflection\Types\Void_;
use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\OrganizationFixtures;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrganizationActionTest extends FunctionalTestBase
{
    const ENDPOINT = 'v1/api/organization';

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

    public function testUpdateOrganizationRootUserSuccessResponse():void
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();
        $payload = [
            'email' => 'info@email.com',
            'name' => 'new name',
            'legalDocument' => '1111111X',
            'address' => 'New address'
        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_PUT,
            sprintf('%s/%s',self::ENDPOINT,OrganizationFixtures::ORGANIZATION_UUID),
            [],[],[],
            json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        dd($response);
        self::assertEquals(Response::HTTP_OK,$response->getStatusCode());

    }


}