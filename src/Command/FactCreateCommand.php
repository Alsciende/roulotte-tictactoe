<?php

namespace App\Command;

use App\Document\PlayedPosition;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:fact:create',
    description: 'Create a fact',
)]
class FactCreateCommand extends Command
{
    private DocumentManager $manager;

    public function __construct(DocumentManager $manager)
    {
        $this->manager = $manager;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('x', InputArgument::REQUIRED, 'X position')
            ->addArgument('y', InputArgument::REQUIRED, 'Y position')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $x = (int) $input->getArgument('x');
        $y = (int) $input->getArgument('y');

        $fact = new PlayedPosition($x, $y);

        $this->manager->persist($fact);
        $this->manager->flush();

        $io->success('Created fact ' . $fact->getId());

        return Command::SUCCESS;
    }
}
