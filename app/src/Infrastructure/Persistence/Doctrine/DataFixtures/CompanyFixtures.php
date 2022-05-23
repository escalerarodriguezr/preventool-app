<?php

namespace Preventool\Infrastructure\Persistence\Doctrine\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Preventool\Domain\Company\Model\Entity\Company;
use Preventool\Domain\Shared\Value\NonEmptyString;

class CompanyFixtures extends Fixture implements FixtureInterface
{
    const COMPANY_UUID = '03df8a4e-4598-4033-9bbf-8cd90d7b1f26';
    const COMPANY_NAME = 'Preventool';
    const COMPANY_LEGAL_DOCUMENT = 'X9898989811C';
    const COMPANY_ADDRESS = 'Default Address';


    public function load(ObjectManager $manager)
    {
        $company = new Company(
            self::COMPANY_UUID,
            new NonEmptyString(self::COMPANY_NAME),
            self::COMPANY_LEGAL_DOCUMENT,
            self::COMPANY_ADDRESS
        );
        $manager->persist($company);
        $manager->flush();
    }
    
}