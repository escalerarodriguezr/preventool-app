<?php

namespace PHPUnit\Tests\Functional\Http\Company\GetCompany;

use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\CompanyFixtures;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetCompanyActionTest extends FunctionalTestBase
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

    public function testGetCompanyByRootClient():void
    {
        $this->prepareDataBase();
        $this->getAuthenticatedRootClient();
        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT
        );
        $response = self::$authenticatedRootClient->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);

        self::assertEquals(CompanyFixtures::COMPANY_UUID, $responseData['uuid']);
        self::assertEquals(CompanyFixtures::COMPANY_NAME, $responseData['name']);
        self::assertEquals(CompanyFixtures::COMPANY_LEGAL_DOCUMENT, $responseData['legalDocument']);
        self::assertEquals(CompanyFixtures::COMPANY_ADDRESS, $responseData['address']);
    }

    public function testGetCompanyNotFoundException():void
    {
        $this->databaseTool->loadFixtures([
            UserFixtures::class
        ]);
        $this->getAuthenticatedRootClient();
        self::$authenticatedRootClient->request(
            Request::METHOD_GET,
            self::ENDPOINT
        );
        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_CONFLICT,$response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertStringContainsString("CompanyNotFoundException", $responseData['class']);
    }
}