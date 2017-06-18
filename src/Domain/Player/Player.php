<?php
namespace Game\Domain\Player;

use Game\Domain\Figure\Figure;

class Player
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
}