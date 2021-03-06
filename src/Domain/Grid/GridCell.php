<?php
namespace Game\Domain\Grid;

use Game\Domain\Figure\Figure;

/**
 * At the end this class became redundant
 */
class GridCell
{
    /**
     * @var Figure
     */
    private $figure;

    public function __construct(Figure $figure)
    {
        $this->figure = $figure;
    }

    public function figure()
    {
        return $this->figure;
    }

    public function __toString()
    {
        return $this->figure->type();
    }
}