<?php
namespace Game\Infrastructure\Events;

use Game\Domain\Grid\GridCellCollection;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\Event;

class GridRedraw extends Event
{

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var GridCellCollection
     */
    private $grid;

    function __construct(OutputInterface $output, GridCellCollection $grid)
    {
        $this->output = $output;
        $this->grid = $grid;
    }

    public function grid()
    {
        return $this->grid;
    }

    public function output()
    {
        return $this->output;
    }
}