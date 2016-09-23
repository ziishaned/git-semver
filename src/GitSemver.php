<?php 

namespace Zeeshan\GitSemver;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputOption;
use Zeeshan\GitSemver\Commands\GitSemverCommand;
use Zeeshan\GitSemver\Commands\GitSemverMajorCommand;
use Zeeshan\GitSemver\Commands\GitSemverMinorCommand;
use Zeeshan\GitSemver\Commands\GitSemverPatchCommand;
use Zeeshan\GitSemver\Commands\GitSemverCurrentCommand;

class GitSemver
{
	const APPLICATION_NAME = 'Git Semver';

	const APPLICATION_VERSION = '1.0.0';  

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

	public function getCommands()
	{
		return $this->commands;
	}

	public function runApplication()
	{
		$application = new Application(self::APPLICATION_NAME, self::APPLICATION_VERSION);
		$application->addCommands($this->getCommands());
		$application->setDefaultCommand('gitsemver');
		$application->run();
	}
}