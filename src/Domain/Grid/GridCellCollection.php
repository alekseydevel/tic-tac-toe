<?php
namespace Game\Domain\Grid;

use Game\Domain\Figure\EmptyFigure;

class GridCellCollection
{
    private $cells = [];

    private $maxSize;

    public function __construct($maxSize = 3)
    {
        if ($maxSize < 2 || $maxSize % 2 == 0) {
            throw new \InvalidArgumentException('Invalid grid size');
        }

        $this->maxSize = $maxSize;
    }

    public function sideSize()
    {
        return (int) $this->maxSize;
    }

    public function add(GridCellPointer $cellPointer)
    {
        if (empty($this->cells[$cellPointer->row()])) {
            $this->cells[$cellPointer->row()] = [];
        }

        if ($cellPointer->row() > $this->maxSize - 1 || $cellPointer->col() > $this->maxSize - 1) {
            throw new \OutOfBoundsException("Wrong col/row index! Max side size = {$this->maxSize}");
        }

        $this->cells[$cellPointer->row()][$cellPointer->col()] = $cellPointer->cell();
    }

    public function cells()
    {
        return $this->cells;
    }

    public static function createEmpty($size)
    {
        $cells = new self($size);

        for($col = 0; $col < $size; $col++) {
            for($row = 0; $row < $size; $row++) {
                $cells->add(new GridCellPointer($col, $row, new GridCell(new EmptyFigure())));
            }
        }

        return $cells;
    }

    public function clear()
    {
        $this->cells = [];
    }
}