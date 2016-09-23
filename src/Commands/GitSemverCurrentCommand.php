<?php

namespace Zeeshan\GitSemver\Commands;

use Zeeshan\GitSemver\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package Git Semver
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class GitSemverCurrentCommand extends BaseCommand
{
    /**
     * @var Symfony\Component\Console\Output\OutputInterface
     */
    protected $output;

    /**
     * Configures the command
     * @return void
     */
    public function configure()
    {
        $this->setName('current')
             ->setDescription('Display the current version.')
             ->addOption('fetch', 'f', InputOption::VALUE_NONE, 'Fetch the latest versions from remote');
    }

    /**
     * Executes the command
     * @param  Symfony\Component\Console\Output\OutputInterface                 $output 
     * @param  Symfony\Component\Console\Input\InputInterface\InputInterface    $input  
     * @return void                  
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        if ($input->getOption('fetch')) {
            $this->fetchVersions();
        };

        $currentVersion = $this->getCurrentVersion();
        $output->writeln('<info>Current version is ' . $currentVersion . '</info>');
    }
}
