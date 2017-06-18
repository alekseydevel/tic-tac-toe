<?php
namespace Game\Command;

use Game\Domain\Grid\GridCell;
use Game\Domain\Grid\GridCellPointer;
use Game\Infrastructure\Events\Events;
use Game\Infrastructure\Events\GridRedraw;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PlaceTheObject extends Command
{
    public function configure()
    {
        $this
            ->setName('game:object:place')
            ->addArgument('row', InputArgument::REQUIRED)
            ->addArgument('column', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var GameApp $app */
        $app = $this->getApplication();
        $player = $app->players()->randomPlayer();
        $grid = $app->grid();

        $cell = new GridCellPointer(
            $input->getArgument('row'),
            $input->getArgument('column'),
            new GridCell($player->figure())
        );

        $grid->add($cell);

        $app->gameDispatcher()->dispatch(
            Events::GRID_CHANGED,
            new GridRedraw($output, $grid)
        );
    }
}