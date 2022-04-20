<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Ui\Http\Service;

use Preventool\Domain\Shared\Service\UuidValidator\UuidValidator;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validation;


final class UuidValidatorSymfony implements UuidValidator
{
    public function validate(string $uuid): void
    {
        $validator = Validation::createValidator();

        $uuidContraint = new Uuid();
        $uuidContraint->message = sprintf("%s has invalid Uuid format",$uuid);

        $errors = $validator->validate(
            $uuid,
            $uuidContraint
        );

        if (count($errors))
        {
            throw new BadRequestHttpException( $uuidContraint->message);
        }
    }

}