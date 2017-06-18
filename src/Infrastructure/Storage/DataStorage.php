<?php
namespace Game\Infrastructure\Storage;

use Game\Domain\Grid\GridCellCollection;

interface DataStorage
{
    public function savePlayers();
    public function fetchPlayers();

    public function saveGrid(GridCellCollection $grid);
    public function fetchGrid();

    public function clear();
}