<?php
namespace Game\Domain\Conditions;

use Game\Domain\Grid\GridCellCollection;

class GridFinishedCondition
{
    /**
     * @var GridCellCollection
     */
    private $grid;

    public function __construct(GridCellCollection $grid)
    {
        $this->grid = $grid;
    }

    public function isSatisfied()
    {
        return $this->checkHor() || $this->checkVer() || $this->checkDiag();
    }

    private function checkHor()
    {
        foreach($this->grid->cells() as $rowIndex => $row) {
            if (count(array_unique(array_values($row))) == 1) {
                return true;
            }
        }

        return false;
    }

    private function checkVer()
    {
        $colData = [];
        for($row = 0; $row < 3; $row++) {
            for($col = 0; $col < 3; $col++) {
                $colData[] = $this->grid->cells()[$col][$row];
            }
            if (count(array_unique(array_values($colData))) == 1) {
                return true;
            }
        }

        return false;
    }

    private function checkDiag()
    {
        // ToDo: implement diagonal check
        return false;
    }
}