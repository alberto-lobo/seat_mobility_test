<?php

namespace App\Infrastructure\Ui;

use App\Application\MowerRemoteHandler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'mower:send-movement',
    description: 'This command allows you to send movement orders to the mowers in the system.',
    hidden: false
)]
class MowerRemoteCommand extends Command
{
    public function __construct(private readonly MowerRemoteHandler $mowerRemoteHandler)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('file', InputArgument::REQUIRED, 'Select the path of the file with the orders');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $outputStyle = new OutputFormatterStyle('yellow', 'black', ['bold']);
        $output->getFormatter()->setStyle('title', $outputStyle);
        $outputStyle = new OutputFormatterStyle('red', 'black', ['bold']);
        $output->getFormatter()->setStyle('error', $outputStyle);

        $response = $this->mowerRemoteHandler->__invoke($input->getArgument('file'));

        foreach ($response->read() as $item) {
            $output->writeln($item);
        }

        return Command::SUCCESS;
    }
}