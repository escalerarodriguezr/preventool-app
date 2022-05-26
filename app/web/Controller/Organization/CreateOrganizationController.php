<?php
declare(strict_types=1);

namespace App\Controller\Organization;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateOrganizationController
{


    public function __construct()
    {
    }

    public function __invoke():Response
    {
        return new JsonResponse(
            null,
            Response::HTTP_CREATED
        );
        // TODO: Implement __invoke() method.
    }


}