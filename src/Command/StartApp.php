<?php
namespace Game\Command;

use Game\Domain\Grid\GridCell;
use Game\Domain\Grid\GridCellCollection;
use Game\Domain\Figure\CrossFigure;
use Game\Domain\Grid\GridCellPointer;
use Game\Infrastructure\Events\Events;
use Game\Infrastructure\Events\GridRedraw;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartApp extends Command
{
    const GRID_SIDE_SIZE = 3;

    /** @var GridCellCollection */
    private $grid;
    private $output;

    public function configure()
    {
        $this->setName('game:start');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->initGrid();
    }

    private function initGrid()
    {
        if (empty($this->grid)) {
            $this->grid = GridCellCollection::createEmpty(self::GRID_SIDE_SIZE);

            $this->initPrimaryCells();
        }
        else {
            $this->grid = $this->app()->storage()->fetchGrid();
        }
    }

    private function initPrimaryCells()
    {
        $this->grid->add(new GridCellPointer(0, 1, new GridCell(new CrossFigure())));
        $this->grid->add(new GridCellPointer(2, 0, new GridCell(new CrossFigure())));

        $this->app()->setGrid($this->grid);
        $this->app()->gameDispatcher()->dispatch(
            Events::GRID_CHANGED,
            new GridRedraw($this->output, $this->grid)
        );
    }

    /** @return GameApp */
    private function app()
    {
        return $this->getApplication();
    }
}