<?php
namespace Game\Domain\Grid;

use Game\Domain\Figure\EmptyFigure;

class EmptyGridFactory
{
    public static function createForSize($size)
    {
        $cells = new GridCellCollection($size);
        for($col = 0; $col < $size; $col++) {
            for($row = 0; $row < $size; $row++) {
                $cells->add(new GridCellPointer($col, $row, new GridCell(new EmptyFigure())));
            }
        }
        
        return $cells;
    }
}
