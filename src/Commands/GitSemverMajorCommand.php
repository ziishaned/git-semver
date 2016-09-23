<?php

namespace Zeeshan\GitSemver\Commands;

use Zeeshan\GitSemver\GitSemver;
use Zeeshan\GitSemver\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitSemverMajorCommand extends BaseCommand
{
    public function configure()
    {
        $this->setName('major')
             ->setDescription('Increment major component with value of 1.')
             ->addOption('prefix', null, InputOption::VALUE_REQUIRED, 'Add a prefix to release')
             ->addOption('postfix', null, InputOption::VALUE_REQUIRED, 'Add a postfix to release')
             ->addOption('fetch', 'f', InputOption::VALUE_NONE, 'Fetch the latest versions from remote');
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        if ($input->getOption('fetch')) {
            $this->fetchVersions();
        };

        $currentVersion = $this->getVersion();
        $majorVersion = $this->makeMajor($currentVersion);

        if ($input->getOption('prefix') || $input->getOption('postfix')) {
            if ($input->getOption('prefix') && $input->getOption('postfix')) {
                $majorVersion = $input->getOption('prefix') . $majorVersion . $input->getOption('postfix');
            } else {
                $majorVersion = ($input->getOption('prefix') === null) ? $majorVersion . $input->getOption('postfix') : $input->getOption('prefix') . $majorVersion;
            }
            $this->createMajorRelease($majorVersion);

            $output->writeln('<info>Major release ' . $majorVersion . ' successfully created.</info>');
            exit(1);
        }

        $this->createMajorRelease($majorVersion);
        $output->writeln('<info>Major release ' . $majorVersion . ' successfully created.</info>');
        exit(1);
    }

    public function makeMajor($version)
    {
        $version    = explode('.', $version);
        $version[1] = $version[1] + 1;
        $version    = implode('.', $version);

        return $version;
    }

    public function createMajorRelease($version)
    {
        $command = 'git tag ' . $version;
        $this->runCommand($command);

        return true;
    }
}
