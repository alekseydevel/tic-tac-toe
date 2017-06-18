<?php

use Game\Domain\Figure\CrossFigure;
use Game\Domain\Grid\EmptyGridFactory;
use Game\Domain\Grid\GridCell;
use Game\Domain\Grid\GridCellPointer;
use PHPUnit\Framework\TestCase;

class WrongObjectPlacesTest extends TestCase
{

    /**
     * @test
     */
    public function shouldAddCellValue()
    {
        $grid = EmptyGridFactory::createForSize(3);
        $grid->add(new GridCellPointer(2, 2, new GridCell(new CrossFigure())));

        $this->assertTrue(true);
    }

    /**
     * @test
     * @expectedException OutOfBoundsException
     */
    public function shouldThrowException()
    {
        $grid = EmptyGridFactory::createForSize(3);
        $grid->add(new GridCellPointer(10000, 2, new GridCell(new CrossFigure())));
    }

}