<?php
namespace Game\Domain\Grid;

class GridCellPointer
{
    /** @var GridCell $cell */
    private $cell;

    private $row;

    private $col;

    public function __construct($row, $col, GridCell $cell)
    {
        $this->row = $row;
        $this->col = $col;
        $this->cell = $cell;
    }

    public function cell()
    {
        return $this->cell->figure()->type();
    }

    public function row()
    {
        return $this->row;
    }

    public function col()
    {
        return $this->col;
    }
}