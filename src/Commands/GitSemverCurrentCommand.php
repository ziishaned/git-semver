<?php

namespace Zeeshan\GitSemver\Commands;

use Zeeshan\GitSemver\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitSemverCurrentCommand extends BaseCommand
{
    protected $output;

    public function configure()
    {
        $this->setName('current')
             ->setDescription('Display the current version.')
             ->addOption('fetch', 'f', InputOption::VALUE_NONE, 'Fetch the latest versions from remote');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        if ($input->getOption('fetch')) {
            $this->fetchVersions();
        };

        $currentVersion = $this->getVersion();
        $output->writeln('<info>Current version is ' . $currentVersion . '</info>');
    }
}
