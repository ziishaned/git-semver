<?php 

namespace Zeeshan\GitSemver\Commands;

use Zeeshan\GitSemver\GitSemver;
use Zeeshan\GitSemver\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitSemverMinorCommand extends BaseCommand
{
	public function configure()
    {
 		$this->setName('minor')
 			 ->setDescription('Create a minor release.')
 			 ->addOption('prefix', NULL, InputOption::VALUE_REQUIRED, 'Add a prefix to release')
 			 ->addOption('postfix', NULL, InputOption::VALUE_REQUIRED, 'Add a postfix to release')
 			 ->addOption('fetch', 'f', InputOption::VALUE_NONE, 'Fetch the latest versions from remote');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
    	$this->output = $output;

    	if($input->getOption('fetch')) {
			$this->fetchVersions();    		
    	};

    	$currentVersion = $this->getVersion();
    	$minorVersion = $this->makeMinor($currentVersion);    	

    	if ($input->getOption('prefix') || $input->getOption('postfix')) {
            if ($input->getOption('prefix') && $input->getOption('postfix')) {
                $minorVersion = $input->getOption('prefix') . $minorVersion . $input->getOption('postfix');
            } else {
                $minorVersion = ($input->getOption('prefix') === null) ? $minorVersion . $input->getOption('postfix') : $input->getOption('prefix') . $minorVersion;
            }
            $this->createMinorRelease($minorVersion);

            $output->writeln('<info>Minor release ' . $minorVersion . ' successfully created.</info>');            
            exit(1);
        }

		$this->createMinorRelease($minorVersion);
    	$output->writeln('<info>Minor release ' . $minorVersion . ' successfully created.</info>');
    	exit(1);   
    }

    public function makeMinor($version)
    {
    	$version 	= explode('.', $version);
    	$version[1] = $version[1] + 1;
    	$version 	= implode('.', $version);

    	return $version;
    }

    public function createMinorRelease($version)
    {
    	$command = 'git tag ' . $version;
    	$this->runCommand($command);

    	return true;
    }
}