<?php

namespace PHPUnit\Tests\Functional\Http\Company\GetCompany;

use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\CompanyFixtures;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;

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

        dd("llega");
    }


}