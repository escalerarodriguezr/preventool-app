<?php
declare(strict_types=1);

namespace App\Controller\User;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UploadUserAvatarController
{
    public function __construct()
    {
    }

    public function __invoke(string $uuid)
    {
        // TODO: Implement __invoke() method.
        return new JsonResponse(null,Response::HTTP_OK);
    }


}