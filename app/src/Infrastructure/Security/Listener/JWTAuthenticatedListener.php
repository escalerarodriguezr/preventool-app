<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Security\Listener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTAuthenticatedEvent;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserAccessDeniedException;
use Preventool\Domain\User\Model\Exception\UserAccountNotActiveException;
use Preventool\Domain\User\Model\Exception\UserNotFoundException;
use Preventool\Domain\User\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTAuthenticatedListener
{
    private ?User $actionUser;

    public function __construct(private RequestStack $requestStack, private UserRepository $userRepository)
    {
    }

    public function onJWTAuthenticated(JWTAuthenticatedEvent $event)
    {
        $userId = $event->getPayload()['userId'];
        $userUuid = $event->getPayload()['userUuid'];
        $userRole = $event->getPayload()['userRole'];

        try{
            $this->actionUser = $this->userRepository->find($userId);
        }catch (UserNotFoundException $exception){
            throw ActionUserAccessDeniedException::fromSecurity($userUuid);
        }

        $this->checkIsActiveAccount();
        $this->addRequestParams($userId,$userUuid,$userRole);

    }

    private function checkIsActiveAccount():void
    {
        if(!$this->actionUser->isActive() || !$this->actionUser->isEmailConfirmed()){
            throw UserAccountNotActiveException::fromSecurity($this->actionUser->getEmail()->getValue());
        }
    }

    private function addRequestParams(int $userId, string $userUuid,string $userRole): void
    {
        $request = $this->requestStack->getCurrentRequest();
        $request->attributes->set('userId', $userId);
        $request->attributes->set('userUuid', $userUuid);
        $request->attributes->set('userRole', $userRole);
    }

}