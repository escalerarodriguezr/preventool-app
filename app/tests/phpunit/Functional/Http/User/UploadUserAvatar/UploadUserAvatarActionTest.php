<?php

namespace PHPUnit\Tests\Functional\Http\User\UploadUserAvatar;


use PHPUnit\Tests\Functional\Http\FunctionalTestBase;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadUserAvatarActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/user/%s/avatar';

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

    public function testRootUserUploadSelfUserAvatarSuccessResponse()
    {
        $this->prepareDataBase();;
        $this->getAuthenticatedRootClient();
        //Fake file
        $avatar = new UploadedFile(
            __DIR__.'/avatar.png',
            'avatar.png'
        );

        self::$authenticatedRootClient->request(
            Request::METHOD_POST,
            sprintf(self::ENDPOINT,UserFixtures::ROOT_UUID),
            [],
            ['avatar' => $avatar]
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_OK,$response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertArrayHasKey('avatarResource', $responseData);
    }

    public function testRootUserUploadSelfUserAvatarErrorInputBadRequestResponse()
    {
        $this->prepareDataBase();;
        $this->getAuthenticatedRootClient();
        //Fake file
        $avatar = new UploadedFile(
            __DIR__.'/avatar.png',
            'avatar.png'
        );

        self::$authenticatedRootClient->request(
            Request::METHOD_POST,
            sprintf(self::ENDPOINT,UserFixtures::ROOT_UUID),
            [],
            ['avatar_fake' => $avatar]
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testUploadUserAvatarInputMimeErrorBadRequestResponse()
    {
        $this->prepareDataBase();;
        $this->getAuthenticatedRootClient();
        
        $avatar = new UploadedFile(
            __DIR__.'/fake.txt',
            'fake.txt'
        );

        self::$authenticatedRootClient->request(
            Request::METHOD_POST,
            sprintf(self::ENDPOINT,UserFixtures::ROOT_UUID),
            [],
            ['avatar_fake' => $avatar]
        );

        $response = self::$authenticatedRootClient->getResponse();
        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}