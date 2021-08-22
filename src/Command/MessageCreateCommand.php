<?php

namespace App\Command;

use App\Message\PlayMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:message:create',
    description: 'Add a short description for your command',
)]
class MessageCreateCommand extends Command
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
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

        $message = new PlayMessage($x, $y);

        $this->messageBus->dispatch($message);

        $io->success("Dispatched.");

        return Command::SUCCESS;
    }
}
