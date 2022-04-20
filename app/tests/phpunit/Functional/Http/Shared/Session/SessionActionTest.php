<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http\Shared\Session;

use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Preventool\Infrastructure\Ui\Http\Service\Session\SessionView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/session';

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

    public function testGetSession()
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

        self::assertEquals(UserFixtures::ROOT_NAME, $responseData[SessionView::NAME]);
        self::assertEquals(UserFixtures::ROOT_LASTNAME, $responseData[SessionView::LASTNAME]);
        self::assertEquals(UserFixtures::ROOT_EMAIL, $responseData[SessionView::EMAIL]);
        self::assertEquals(UserFixtures::ROOT_ROLE, $responseData[SessionView::ROLE]);
        self::assertEquals(UserFixtures::ROOT_ID, $responseData[SessionView::USER_ID]);
        self::assertEquals(UserFixtures::ROOT_UUID, $responseData[SessionView::USER_UUID]);
        self::assertIsString($responseData[SessionView::TOKEN]);
        
    }


}