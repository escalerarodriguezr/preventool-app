<?php
declare(strict_types=1);

namespace App\Controller\User;

use Preventool\Infrastructure\Ui\Http\Request\DTO\User\UploadUserAvatarRequest;
use Preventool\Infrastructure\Ui\Http\Service\HttpActionUserService;
use Preventool\Infrastructure\Ui\Http\Service\UuidValidatorSymfony;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UploadUserAvatarController
{
    public function __construct(
        private HttpActionUserService $httpActionUserService,
        private UuidValidatorSymfony $uuidValidator

    )
    {
    }

    public function __invoke(string $uuid, UploadUserAvatarRequest $uploadUserAvatarRequest)
    {
        $this->uuidValidator->validate($uuid);
        return new JsonResponse(null,Response::HTTP_OK);
    }


}