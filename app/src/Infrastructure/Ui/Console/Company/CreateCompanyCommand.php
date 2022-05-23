<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Ui\Console\Company;

use Preventool\Domain\Company\Model\Entity\Company;
use Preventool\Domain\Company\Repository\CompanyRepository;
use Preventool\Domain\Shared\Service\IdentifierGenerator\IdentifierGenerator;
use Preventool\Domain\Shared\Value\NonEmptyString;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Question\Question;

class CreateCompanyCommand extends Command
{
    protected static $defaultName = 'app:create-company';

    public function __construct(
        private IdentifierGenerator $identifierGenerator,
        private CompanyRepository $repository
    )
    {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this->setDescription('Create Company Entity');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Create Company Entity',
            '============',
            '',
        ]);

        $helper = $this->getHelper('question');
        $question = new Question('Please enter company name: ', 'defaul company');
        $name = $helper->ask($input, $output, $question);
        if (empty($name)) {
            throw new \DomainException('Invalid company name');
        }

        $company = new Company(
            $this->identifierGenerator->uuid(),
            new NonEmptyString($name)
        );

        $this->repository->save($company);

        $output->writeln([
            'Company Created: '. $company->getUuid(),
            '============',
            '',
        ]);

        return Command::SUCCESS;
    }

}