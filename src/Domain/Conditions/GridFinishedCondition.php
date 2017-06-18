<?php
namespace Game\Domain\Conditions;

use Game\Domain\Grid\GridCellCollection;

class GridFinishedCondition
{
    const VALID_SYMBOLS = ['X', '0'];

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
            if ($this->isFullLineWithSameSymbols($row)) {
                return true;
            }
        }

        return false;
    }

    private function checkVer()
    {
        for($row = 0; $row < $this->grid->sideSize(); $row++) {

            $colData = [];

            for($col = 0; $col < $this->grid->sideSize(); $col++) {
                $colData[] = $this->grid->cells()[$col][$row];
            }
            if ($this->isFullLineWithSameSymbols($colData)) {
                return true;
            }
        }

        return false;
    }

    private function checkDiag()
    {
        return $this->checkTopLeftToBottomRightDiagonal() || $this->checkTopRightToBottomLeftDiagonal();
    }

    private function checkTopLeftToBottomRightDiagonal()
    {
        $data = [];

        for($i = 0; $i < $this->grid->sideSize(); $i++) {
            $data[] = $this->grid->cells()[$i][$i];
        }

        return $this->isFullLineWithSameSymbols($data);
    }

    private function checkTopRightToBottomLeftDiagonal()
    {
        $data = [];
        $j = 0;

        for($i = $this->grid->sideSize() - 1; $i >= 0; $i--) {
            $data[] = $this->grid->cells()[$i][$j];
            $j++;
        }

        return $this->isFullLineWithSameSymbols($data);
    }

    public function isFullLineWithSameSymbols(array $data)
    {
        $symbolsInLine = array_values($data);

        return count(array_unique($symbolsInLine)) == 1 && $this->isValidSymbol($symbolsInLine[0]);
    }

    private function isValidSymbol($ch)
    {
        return in_array($ch, self::VALID_SYMBOLS);
    }
}