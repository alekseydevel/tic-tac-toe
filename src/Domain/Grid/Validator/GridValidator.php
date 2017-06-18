<?php
namespace Game\Domain\Grid\Validator;

use Game\Domain\Grid\GridCellCollection;

class GridValidator
{
    private $size;

    public function __construct($size)
    {
        $this->size = $size;
    }

    public function validateSize(GridCellCollection $grid)
    {
        $count = 0;

        foreach ($grid->cells() as $row => $cols) {
            if (count($cols) != $this->size) {
                throw new \RuntimeException("Empty or not valid grid. Please, run game:start command");
            }
            $count += $this->size;
        }

        if ($count != pow($this->size, 2)) {
            throw new \RuntimeException("Empty or not valid grid. Please, run game:start command");
        }
    }
}