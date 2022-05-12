<?php
declare(strict_types=1);

namespace Preventool\Application\User\QueryHandler\GetUserByUuidQueryHandler;

use DateTimeInterface;
use Preventool\Application\User\Query\GetUserByUuidQuery\GetUserByUuidQuery;
use Preventool\Domain\Shared\Bus\Query\QueryHandler;
use Preventool\Domain\User\Repository\UserRepository;

class GetUserByUuidQueryHandler implements QueryHandler
{

    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function __invoke(GetUserByUuidQuery $query): GetUserByUuidQueryView
    {
        $userEntity = $this->userRepository->findByUuid($query->getUuid());

        return (new GetUserByUuidQueryView())
        ->setId($userEntity->getId())
        ->setUuid($userEntity->getUuid())
        ->setName($userEntity->getName()->getValue())
        ->setLastName($userEntity->getLastName()->getValue())
        ->setAvatar($userEntity->getAvatarResource())
        ->setEmail($userEntity->getEmail()->getValue())
        ->setRole($userEntity->getRole()->getValue())
        ->setCreatorUuid(!empty($userEntity->getCreator()) ? $userEntity->getCreator()->getUuid() : null)
        ->setCreatedOn($userEntity->getCreatedOn()->format(DateTimeInterface::RFC3339))
        ->setIsActive($userEntity->isActive())
        ->setIsEmailConfirmed($userEntity->isEmailConfirmed());
    }


}