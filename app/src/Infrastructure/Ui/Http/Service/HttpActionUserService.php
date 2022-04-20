<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Ui\Http\Service;

use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserAccessDeniedException;
use Preventool\Domain\User\Model\Exception\UserAccountNotActiveException;
use Preventool\Domain\User\Model\Exception\UserNotFoundException;
use Preventool\Domain\User\Repository\UserRepository;
use Preventool\Infrastructure\Security\Listener\JWTCreatedListener;
use Symfony\Component\HttpFoundation\RequestStack;

class HttpActionUserService
{

    private int $userId;
    private string $userUuid;
    private User $sessionUser;

    public function __construct(
        private RequestStack $requestStack,
        private UserRepository $userRepository
    )
    {

        $this->userId = $this->requestStack->getCurrentRequest()->get(JWTCreatedListener::USER_ID);
        $this->userUuid = $this->requestStack->getCurrentRequest()->get(JWTCreatedListener::USER_UUID);
        try{
            $this->sessionUser = $this->userRepository->find($this->userId);
        }catch (UserNotFoundException $exception){
            throw ActionUserAccessDeniedException::fromHttpActionUserService($this->userUuid);
        }

        $this->checkIsActiveAccount();
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUserUuid(): string
    {
        return $this->userUuid;
    }


    public function getSessionUser(): ?User
    {
        return $this->sessionUser;
    }


    private function checkIsActiveAccount():void
    {
        if(!$this->sessionUser->isActive() || !$this->sessionUser->isEmailConfirmed()){
            throw UserAccountNotActiveException::fromHttpActionUserService($this->sessionUser->getEmail()->getValue());
        }
    }
}