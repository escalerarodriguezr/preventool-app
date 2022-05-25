<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http\Company\UpdateCompany;


use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\CompanyFixtures;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Preventool\Infrastructure\Ui\Http\Request\DTO\Company\UpdateCompanyRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateCompanyActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/company';

    public function setUp():void
    {
        parent::setUp();
    }

    private function prepareDataBase():void
    {
        $this->databaseTool->loadFixtures([
            UserFixtures::class,
            CompanyFixtures::class
        ]);
    }

    public function testUpdateCompanyByRootUserSuccessResponse():void
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();

        $payload = [
            UpdateCompanyRequest::NAME => "new company",
            UpdateCompanyRequest::LEGAL_DOCUMENT => "X99878787Z",
            UpdateCompanyRequest::ADDRESS => "New Address"

        ];

        self::$authenticatedRootClient->request(
            Request::METHOD_PUT,
            self::ENDPOINT,
            [],[],[],
            \json_encode($payload)
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_OK,$response->getStatusCode());
    }


}