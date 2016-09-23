<?php

namespace Zeeshan\GitSemver;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputOption;
use Zeeshan\GitSemver\Commands\GitSemverCommand;
use Zeeshan\GitSemver\Commands\GitSemverMajorCommand;
use Zeeshan\GitSemver\Commands\GitSemverMinorCommand;
use Zeeshan\GitSemver\Commands\GitSemverPatchCommand;
use Zeeshan\GitSemver\Commands\GitSemverCurrentCommand;

/**
 * @package Git Semver
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class GitSemver
{
    const APP_NAME = 'Git Semver';

    const APP_VERSION = '1.0.0';

    /**
     * Contains all regitered commands
     * @var array
     */
    private $commands = [];

    public function __construct()
    {
        $this->commands = [
            new GitSemverCommand(),
            new GitSemverMajorCommand(),
            new GitSemverMinorCommand(),
            new GitSemverPatchCommand(),
            new GitSemverCurrentCommand(),
        ];
    }

    /**
     * Return the commands array
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * Application main entery point
     * @return void
     */
    public function runApplication()
    {
        $application = new Application(self::APP_NAME, self::APP_VERSION);
        $application->addCommands($this->getCommands());
        $application->setDefaultCommand('gitsemver');
        $application->run();
    }
}
