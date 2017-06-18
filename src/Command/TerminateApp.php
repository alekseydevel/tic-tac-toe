<?php
namespace Game\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TerminateApp extends Command
{
    public function configure()
    {
        $this->setName('game:terminate');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var GameApp $app */
        $app = $this->getApplication();
        $app->terminate();
    }
}