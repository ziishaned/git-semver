<?php

namespace Zeeshan\GitSemver\Commands;

use Zeeshan\GitSemver\GitSemver;
use Zeeshan\GitSemver\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package Git Semver
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class GitSemverMajorCommand extends BaseCommand
{
    /**
     * Configures the command
     * @return void
     */
    public function configure()
    {
        $this->setName('major')
             ->setDescription('Increment major component with value of 1.')
             ->addOption('prefix', null, InputOption::VALUE_REQUIRED, 'Add a prefix to release')
             ->addOption('postfix', null, InputOption::VALUE_REQUIRED, 'Add a postfix to release')
             ->addOption('fetch', 'f', InputOption::VALUE_NONE, 'Fetch the latest versions from remote');
        ;
    }

    /**
     * Executes the command
     * @param  Symfony\Component\Console\Output\OutputInterface                 $output 
     * @param  Symfony\Component\Console\Input\InputInterface\InputInterface    $input  
     * @return void                  
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output   = $output;
        $prefix         = $input->getOption('prefix');
        $postfix        = $input->getOption('postfix');

        if ($input->getOption('fetch')) {
            $this->fetchVersions();
        };

        $currentVersion = $this->getCurrentVersion();
        $majorVersion = $this->makeMajor($currentVersion);

        if ($prefix || $postfix) {
            if ($prefix && $postfix) {
                $majorVersion = $prefix . $majorVersion . $postfix;
            } else {
                $majorVersion = ($prefix === null) ? $majorVersion . $postfix : $prefix . $majorVersion;
            }
            $this->deployRelease($majorVersion);

            $output->writeln('<info>Major release ' . $majorVersion . ' successfully created.</info>');
            exit(1);
        }

        $this->deployRelease($majorVersion);
        $output->writeln('<info>Major release ' . $majorVersion . ' successfully created.</info>');
        exit(1);
    }

    /**
     * Converts current version into sementic versioning minor release.
     * @param  string $version
     * @return string
     */
    public function makeMajor($version)
    {
        $version    = explode('.', $version);
        $version[0] = $version[0] + 1;
        $version    = implode('.', $version);

        return $version;
    }
}
