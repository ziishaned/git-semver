<?php

namespace Zeeshan\GitSemver\Commands;

use Zeeshan\GitSemver\GitSemver;
use Zeeshan\GitSemver\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitSemverPatchCommand extends BaseCommand
{
    public function configure()
    {
        $this->setName('patch')
             ->setDescription('Create patch release.')
             ->addOption('prefix', null, InputOption::VALUE_REQUIRED, 'Add a prefix to release')
             ->addOption('postfix', null, InputOption::VALUE_REQUIRED, 'Add a postfix to release')
             ->addOption('fetch', 'f', InputOption::VALUE_NONE, 'Fetch the latest versions from remote');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        if ($input->getOption('fetch')) {
            $this->fetchVersions();
        };

        $currentVersion = $this->getVersion();
        $patchedVersion = $this->makePatch($currentVersion);

        if ($input->getOption('prefix') || $input->getOption('postfix')) {
            if ($input->getOption('prefix') && $input->getOption('postfix')) {
                $patchedVersion = $input->getOption('prefix') . $patchedVersion . $input->getOption('postfix');
            } else {
                $patchedVersion = ($input->getOption('prefix') === null) ? $patchedVersion . $input->getOption('postfix') : $input->getOption('prefix') . $patchedVersion;
            }
            $this->createPatchRelease($patchedVersion);

            $output->writeln('<info>Patch release ' . $patchedVersion . ' successfully created.</info>');
            exit(1);
        }

        $this->createPatchRelease($patchedVersion);
        $output->writeln('<info>Patch release ' . $patchedVersion . ' successfully created.</info>');
        exit(1);
    }

    public function makePatch($version)
    {
        $version    = explode('.', $version);
        $version[2] = $version[2] + 1;
        $version    = implode('.', $version);

        return $version;
    }

    public function createPatchRelease($version)
    {
        $command = 'git tag ' . $version;
        $this->runCommand($command);

        return true;
    }
}
