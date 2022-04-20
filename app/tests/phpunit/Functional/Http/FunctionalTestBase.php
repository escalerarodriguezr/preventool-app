<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Functional\Http;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Preventool\Domain\User\Repository\UserRepository;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FunctionalTestBase extends WebTestCase
{
    protected AbstractDatabaseTool $databaseTool;
    private static ?KernelBrowser $client = null;
    protected static ?KernelBrowser $baseClient = null;
    protected static ?KernelBrowser $authenticatedRootClient = null;

    public function setUp():void
    {
        parent::setUp();
        $this->getClient();
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    protected function getClient():void
    {
        if (null === self::$client) {
            self::$client = static::createClient();
        }
    }

    protected function getBaseClient():void
    {
        if (null === self::$baseClient) {
            self::$baseClient = clone self::$client;
            self::$baseClient->setServerParameters([
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json',
            ]);
        }
    }

    protected function getAuthenticatedRootClient():void
    {
        if (null === self::$authenticatedRootClient) {
            self::$authenticatedRootClient = clone self::$client;

            $user = static::getContainer()->get(UserRepository::class)->findByEmail(UserFixtures::ROOT_EMAIL);
            $token = static::getContainer()->get(JWTTokenManagerInterface::class)->create($user);

            self::$authenticatedRootClient->setServerParameters([
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_Authorization' => \sprintf('Bearer %s', $token),
            ]);
        }
    }

}