<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

#[AsCommand(
    name: 'event:publish',
    description: 'Add a short description for your command',
)]
class EventPublishCommand extends Command
{
    private HubInterface $hub;

    public function __construct(HubInterface $hub)
    {
        parent::__construct();
        $this->hub = $hub;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $update = new Update(
            'http://example.com/books/1',
            json_encode(['hello' => 'world'])
        );

        $this->hub->publish($update);

        $io->success('Published.');

        return Command::SUCCESS;
    }
}
