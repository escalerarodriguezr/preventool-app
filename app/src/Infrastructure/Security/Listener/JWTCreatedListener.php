<?php

namespace Preventool\Infrastructure\Security\Listener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Preventool\Domain\User\Model\Exception\UserAccountNotActiveException;

class JWTCreatedListener
{
    const USER_ID = 'userId';
    const USER_UUID = 'userUuid';
    const USER_ROLE = 'userRole';


    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $user = $event->getUser();

        if(!$user->isActive() || !$user->isEmailConfirmed()){
            throw UserAccountNotActiveException::fromLoginService($user->getEmail()->getValue());
        }

        $payload = $event->getData();
        $payload[self::USER_ID] = $user->getId();
        $payload[self::USER_UUID] = $user->getUuid();
        $payload[self::USER_ROLE] = $user->getRole()->getValue();
        $event->setData($payload);
    }

}