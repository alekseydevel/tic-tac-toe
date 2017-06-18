<?php
namespace Game\View;

use Game\Domain\Grid\GridCellCollection;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class ConsoleRender
{
    /**
     * @var GridCellCollection
     */
    private $cellCollection;
    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(GridCellCollection $cellCollection, OutputInterface $output)
    {
        $this->cellCollection = $cellCollection;
        $this->output = $output;
    }

    public function render()
    {
        $table = new Table($this->output);
        $table->setRows($this->cellCollection->cells());
        $table->render();
    }
}