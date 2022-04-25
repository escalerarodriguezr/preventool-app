<?php

namespace Preventool\Infrastructure\FileStorage\DigitalOceanStorage;

use League\Flysystem\FilesystemOperator;
use Preventool\Domain\Shared\Service\FileStorageManager\FileStorageManager;
use Psr\Log\LoggerInterface;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DigitalOceanFileStorageManager implements FileStorageManager
{

    public function __construct(
        private FilesystemOperator $defaultStorage,
        private LoggerInterface $logger,
        private string $projectDigitalOceanStoragePath
    )
    {
    }

    public function uploadFile(UploadedFile $file, string $prefix, string $visibility): string
    {
        $fileName = \sprintf('%s%s/%s.%s', $this->projectDigitalOceanStoragePath,$prefix, \sha1(\uniqid()), $file->guessExtension());

        try{
            $this->defaultStorage->writeStream(
                $fileName,
                \fopen($file->getPathname(), 'r'),
                ['visibility' => $visibility]
            );

        }catch (\Exception $e){
            $this->logger->warning("Error uploading file");
            throw new FileNotFoundException('Error uploading file');
        }

        return $fileName;
    }

    public function deleteFile(?string $path): void
    {
        try {
            if (null !== $path) {
                $this->defaultStorage->delete($path);
            }
        } catch (\Exception $e) {
            $this->logger->warning(\sprintf('File %s not found in the storage', $path));
            throw new FileNotFoundException(\sprintf('File %s not found in the storage', $path));
        }
    }


}