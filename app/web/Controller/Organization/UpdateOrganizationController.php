<?php
declare(strict_types=1);

namespace App\Controller\Organization;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrganizationController
{


    public function __construct()
    {
    }

    public function __invoke(string $uuid):Response
    {


        return new JsonResponse(null,Response::HTTP_OK);


    }


}