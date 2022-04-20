<?php

namespace PHPUnit\Tests\Unit\Infrastructure\Ui\Http\Service;

use PHPUnit\Framework\TestCase;
use Preventool\Infrastructure\Ui\Http\Service\UuidValidatorSymfony;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


class UuidValidatorSymfonyTest extends TestCase
{
    public function testUuidIsOk()
    {
        (new UuidValidatorSymfony())->validate("8ea0b2ca-4e21-4155-8bff-b87ccfbad379");
        self::assertEquals(1,1);
    }

    public function testUuidBadRequestHttpException()
    {
        self::expectException(BadRequestHttpException::class);
        (new UuidValidatorSymfony())->validate("8ea0b2ca");
    }

}