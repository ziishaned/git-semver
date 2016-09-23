<?php

namespace Zeeshan\GitSemver\Commands;

use Zeeshan\GitSemver\GitSemver;
use Zeeshan\GitSemver\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package Git Semver
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class GitSemverCommand extends BaseCommand
{
    /**
     * Configures the command
     * @return void
     */
    public function configure()
    {
        $this->setName('gitsemver')
             ->setDescription('Show the detailed usage of commands and options.');
    }

    /**
     * Executes the command
     * @param  Symfony\Component\Console\Output\OutputInterface                 $output 
     * @param  Symfony\Component\Console\Input\InputInterface\InputInterface    $input  
     * @return void                  
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>' . GitSemver::APPLICATION_NAME . '</info> version <comment>' . GitSemver::APPLICATION_VERSION . '</comment>');
        $output->writeln('');
        $output->writeln('<comment>Usage: </comment>');
        $output->writeln('  command [options] [arguments]');
        $output->writeln('');
        $output->writeln('<comment>Options: </comment>');
        $output->writeln('  <info>-h, --help        Display this help message</info>');
        $output->writeln('  <info>-V, --version     Display this application version</info>');
        $output->writeln('  <info>    --ansi        Force ANSI output</info>');
        $output->writeln('  <info>    --no-ansi     Disable ANSI output</info>');
        $output->writeln('  <info>-f  --fetch       Fetch the remote tags before applying the version</info>');
        $output->writeln('  <info>    --prefix      Insert a prefix to the release</info>');
        $output->writeln('  <info>    --postfix     Insert a postfix to the release</info>');
        $output->writeln('');
        $output->writeln('<comment>Available Commands: </comment>');
        $output->writeln('  <info>current           Display current version of the application</info>');
        $output->writeln('  <info>patch             Create a patch release e.g. it will generate x.y.0 to x.y.1</info>');
        $output->writeln('  <info>major             Create a major release e.g. it will generate x.0.z to x.1.z</info>');
        $output->writeln('  <info>minor             Create a minor release e.g. it will generate 0.y.z to 1.y.z</info>');
    }
}
