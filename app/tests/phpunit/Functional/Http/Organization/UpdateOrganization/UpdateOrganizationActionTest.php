<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http\Organization\UpdateOrganization;

use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\OrganizationFixtures;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrganizationActionTest extends FunctionalTestBase
{
    const ENDPOINT = '/api/v1/organization';

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

    public function testUpdateOrganizationByRootUserSuccessResponse():void
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
        self::assertEquals(Response::HTTP_OK,$response->getStatusCode());
    }

    public function testUpdateOrganizationByAdminUserActionUserActionNotAllowedException():void
    {

        $this->prepareDataBase();
        $this->getAuthenticatedAdminFrodoClient();
        $payload = [
            'email' => 'info@email.com',
            'name' => 'new name',
            'legalDocument' => '1111111X',
            'address' => 'New address'
        ];

        self::$authenticatedAdminFrodoClient->request(
            Request::METHOD_PUT,
            sprintf('%s/%s',self::ENDPOINT,OrganizationFixtures::ORGANIZATION_UUID),
            [],[],[],
            json_encode($payload)
        );
        $response = self::$authenticatedAdminFrodoClient->getResponse();
        self::assertEquals(Response::HTTP_CONFLICT,$response->getStatusCode());
    }

}