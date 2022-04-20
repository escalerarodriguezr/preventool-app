<?php
declare(strict_types=1);

namespace App\Controller\Shared\Session;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Preventool\Infrastructure\Ui\Http\Service\HttpActionUserService;
use Preventool\Infrastructure\Ui\Http\Service\Session\SessionView;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionController
{
    public function __construct(
        private HttpActionUserService $httpActionUserService,
        private JWTTokenManagerInterface $jwtManager
    )
    {
    }

    public function __invoke(Request $request)
    {
        return new JsonResponse(
            (new SessionView(
                $this->httpActionUserService->getUserId(),
                $this->httpActionUserService->getUserUuid(),
                $this->httpActionUserService->getSessionUser()->getEmail(),
                $this->httpActionUserService->getSessionUser()->getRole(),
                $this->httpActionUserService->getSessionUser()->getName(),
                $this->httpActionUserService->getSessionUser()->getLastName(),
                $this->jwtManager->create($this->httpActionUserService->getSessionUser())))
                ->toArray(),
            Response::HTTP_OK
        );
    }

}