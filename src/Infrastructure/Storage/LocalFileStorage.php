<?php
namespace Game\Infrastructure\Storage;

use Game\Domain\Figure\FigureFactory;
use Game\Domain\Grid\GridCell;
use Game\Domain\Grid\GridCellCollection;
use Game\Domain\Grid\GridCellPointer;

class LocalFileStorage implements DataStorage
{
    const GRID_KEY = 'grid';

    /** @var string */
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function savePlayers()
    {
        // TODO: Implement savePlayers() method.
    }

    public function fetchPlayers()
    {
        // TODO: Implement fetchPlayers() method.
    }

    public function saveGrid(GridCellCollection $grid)
    {
        file_put_contents($this->file, $this->serialize($grid));
    }

    public function fetchGrid()
    {
        $data = file_get_contents($this->file);
        $array = json_decode($data, true);

        if (!isset($array[self::GRID_KEY])) {
            $array[self::GRID_KEY] = [];
        }

        return $this->unserialize($array[self::GRID_KEY]);
    }

    private function serialize(GridCellCollection $grid)
    {
        $data[self::GRID_KEY] = [];

        foreach ($grid->cells() as $row => $rowData) {
            foreach ($rowData as $col => $cell) {
                $data[self::GRID_KEY][$row][$col] = $cell;
            }
        }
        
        return json_encode($data);
    }

    private function unserialize(array $gridArray)
    {
        $grid = new GridCellCollection(3);
        foreach ($gridArray as $row => $rowData) {
            foreach ($rowData as $col => $cellFigure) {
                $grid->add(new GridCellPointer($row, $col, new GridCell(FigureFactory::fromFigureRepresentation($cellFigure))));
            }
        }

        return $grid;
    }

    public function clear()
    {
        file_put_contents($this->file, '');
    }
}