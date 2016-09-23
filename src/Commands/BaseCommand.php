<?php 

namespace Zeeshan\GitSemver\Commands;

use Symfony\Component\Process\Process;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;

class BaseCommand extends Command
{
    public function runCommand($command)
    {
        $process = new Process($command);
        $process->run();
        return $process->getOutput();
    }

    public function getVersion()
    {
        $command  = 'git tag --list';
        $versions = $this->runCommand($command);
        
        return $this->getCurrentVersion($versions);
    }   

    public function fetchVersions()
    {
        $this->output->writeln('Fetching versions from remote...');

        $command = 'git fetch --tag';
        return $this->runCommand($command);
    }

    public function getCurrentVersion($versions)
    {
        $versions = explode(PHP_EOL, $versions);
        array_pop($versions);

        foreach ($versions as &$version) {
            $version = preg_replace("/[A-Za-z-]/", '', $version);
        }
        natsort($versions);

        return !empty($versions) ? array_pop($versions) : '0.0.0';
    }
}