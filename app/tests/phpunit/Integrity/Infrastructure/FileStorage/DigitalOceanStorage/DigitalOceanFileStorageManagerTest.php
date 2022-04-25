<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Integrity\Infrastructure\FileStorage\DigitalOceanStorage;

use Preventool\Domain\Shared\Service\FileStorageManager\FileStorageManager;
use Preventool\Infrastructure\FileStorage\DigitalOceanStorage\DigitalOceanFileStorageManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DigitalOceanFileStorageManagerTest extends KernelTestCase
{
    public function testUploadFile()
    {
        self::bootKernel();
        $container = static::getContainer();
        $fileStorageManager = $container->get(DigitalOceanFileStorageManager::class);
        $file = new UploadedFile(
            __DIR__.'/avatar.png',
            'avatar.png'
        );

        $fileName = $fileStorageManager->uploadFile($file,'prefix',FileStorageManager::VISIBILITY_PUBLIC);
        self::assertStringContainsString('prefix',$fileName);
    }

    public function testDeleteFile()
    {
        $path = "projects/preventool-dev/prefix/881fb9006a92e1cdc584a3c5bd0f6c66b4a8117f.png";
        self::bootKernel();
        $container = static::getContainer();
        $fileStorageManager = $container->get(DigitalOceanFileStorageManager::class);
        $fileStorageManager->deleteFile($path);
        self::assertEquals(1,1);
    }
}