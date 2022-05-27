<?php

namespace Preventool\Infrastructure\Persistence\Doctrine\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Preventool\Domain\Organization\Model\Entity\Organization;
use Preventool\Domain\Shared\Value\Email;
use Preventool\Domain\Shared\Value\NonEmptyString;
use Preventool\Domain\User\Model\Entity\User;

class OrganizationFixtures extends Fixture implements FixtureInterface, DependentFixtureInterface
{
    const ORGANIZATION_UUID = 'd9419d0f-e8d9-4945-a066-f68ffd54b312';
    const ORGANIZATION_NAME = 'Rivendel';
    const ORGANIZATION_EMAIL = 'info@rivendel.com';
    const ORGANIZATION_LEGAL_DOCUMENT = 'X9898989811C';
    const ORGANIZATION_ADDRESS = 'Default Rivendel Address';

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $organization = new Organization(
            self::ORGANIZATION_UUID,
            new NonEmptyString(self::ORGANIZATION_NAME),
            new Email(self::ORGANIZATION_EMAIL),
            $this->getReference(UserFixtures::ROOT_USER_REFERENCE)
        );
        $manager->persist($organization);
        $manager->flush();
    }




}