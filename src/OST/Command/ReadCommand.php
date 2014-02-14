<?php

namespace OST\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use OST\Reader\File as FileReader;
use OST\Collection\File as FileCollection;

class ReadCommand extends Command
{
    /**
     * configure
     * configs the command, adds optional or required arguments and option switches to the current context
     */
    protected function configure()
    {
        $this
            ->setName('read')
            ->setDescription('Reads files into located in the path')
            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'bla bla'
            );
    }

    /**
     * execute
     * Executes the cli-run and does the logic
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');

        $collection = new FileCollection();
        $reader = new FileReader($collection);

        $files = $reader->read($path);

        $output->writeln($files->getKeys());
    }
}
