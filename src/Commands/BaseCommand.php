<?php

namespace Zeeshan\GitSemver\Commands;

use Symfony\Component\Process\Process;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package Git Semver
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class BaseCommand extends Command
{
    /**
     * This function excepts the command and run it through symfony process component.
     * @param  string $command
     * @return mixed
     */
    public function runCommand($command)
    {
        $process = new Process($command);
        $process->run();
        return $process->getOutput();
    }

    /**
     * Fetch all versions from remote repository.
     * @return mixed
     */
    public function fetchVersions()
    {
        $this->output->writeln('Fetching versions from remote...');

        $command = 'git fetch --tag';
        return $this->runCommand($command);
    }

    /**
     * Get the current version.
     * @return string
     */
    public function getCurrentVersion()
    {
        $command  = 'git tag --list';
        $versions = $this->runCommand($command);

        $versions = explode(PHP_EOL, $versions);
        array_pop($versions);

        foreach ($versions as &$version) {
            $version = preg_replace("/[A-Za-z-]/", '', $version);
        }
        natsort($versions);

        return !empty($versions) ? array_pop($versions) : '0.0.0';
    }

    /**
     * @param  string $version
     * @return boolean
     */
    public function deployRelease($version)
    {
        $command = 'git tag ' . $version;
        $this->runCommand($command);

        return true;
    }
}
