<?php

namespace Zeeshan\GitSemver\Commands;

use Zeeshan\GitSemver\GitSemver;
use Zeeshan\GitSemver\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GitSemverCommand extends BaseCommand
{
    public function configure()
    {
        $this->setName('gitsemver')
             ->setDescription('Show the detailed usage of commands and options.');
    }

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
        $output->writeln('  <info>-f  --fetch       Fetch latest versions from remote</info>');
        $output->writeln('  <info>    --prefix      Insert a prefix to the release</info>');
        $output->writeln('  <info>    --postfix     Insert a postfix to the release</info>');
        $output->writeln('');
        $output->writeln('<comment>Available Commands: </comment>');
        $output->writeln('  <info>current           Display current version of the application</info>');
        $output->writeln('  <info>patch             Increment patch component with value of 1</info>');
        $output->writeln('  <info>major             Increment major component with value of 1</info>');
        $output->writeln('  <info>minor             Increment minor component with value of 1</info>');
    }
}
