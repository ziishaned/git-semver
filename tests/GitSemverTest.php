<?php 

namespace Tests;

use Zeeshan\GitSemver\GitSemver;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Application;

class GitSemverTest extends \PHPUnit_Framework_TestCase
{
	private $app;

    protected function setUp()
    {
        $this->app = new Application('test', false);
        $this->app->setAutoExit(false);
    }
    public function testGetCommandsShouldReturnArray()
    {
        $gitprofile = new GitSemver();
        $this->assertNotEmpty($gitprofile->getCommands());
    }
    public function testCanRunProfileBaseCommand()
    {
        $process = new Process('php bin/git-semver');
        $process->run();
        $this->assertEquals(0, $process->getExitCode());
    }
}