<?php
use Game\Domain\Conditions\GridFinishedCondition;
use Game\Domain\Figure\CrossFigure;
use Game\Domain\Figure\EmptyFigure;
use Game\Domain\Figure\RoundFigure;
use Game\Domain\Grid\EmptyGridFactory;
use Game\Domain\Grid\GridCell;
use Game\Domain\Grid\GridCellPointer;
use PHPUnit\Framework\TestCase;

class GridFinishConditionTest extends TestCase
{
    /**
     * @test
     */
    public function shouldBeFinishedWithFullVertical()
    {
        $condition = new GridFinishedCondition($this->createGridWithFullVertical());
        $this->assertTrue($condition->isSatisfied());
    }

    /**
     * @test
     */
    public function shouldBeFinishedWithFullHorizontal()
    {
        $condition = new GridFinishedCondition($this->createGridWithFullHorizontal());
        $this->assertTrue($condition->isSatisfied());
    }

    /**
     * @test
     */
    public function shouldBeFinishedWithFullDiagonal()
    {
        $condition = new GridFinishedCondition($this->createGridWithFullDiagonal());
        $this->assertTrue($condition->isSatisfied());
    }

    /**
     * @test
     */
    public function shouldNotBeFinishedWithPartialRow()
    {
        $condition = new GridFinishedCondition($this->createGridWithNotFullHorizontal());
        $this->assertTrue(! $condition->isSatisfied());
    }

    /**
     * @test
     */
    public function shouldNotBeFinishedWithPartialDiagonal()
    {
        $condition = new GridFinishedCondition($this->createGridWithNotFullDiagonal());
        $this->assertTrue(! $condition->isSatisfied());
    }

    /**
     * @test
     */
    public function shouldNotBeFinishedWithPartialVertical()
    {
        $condition = new GridFinishedCondition($this->createGridWithNotFullVertical());
        $this->assertTrue(! $condition->isSatisfied());
    }


    private function createGridWithFullHorizontal()
    {
        $grid = EmptyGridFactory::createForSize(3);
        $grid->add(new GridCellPointer(0,0,new GridCell(new CrossFigure())));
        $grid->add(new GridCellPointer(0,1,new GridCell(new CrossFigure())));
        $grid->add(new GridCellPointer(0,2,new GridCell(new CrossFigure())));
        
        $grid->add(new GridCellPointer(1,0,new GridCell(new RoundFigure())));
        $grid->add(new GridCellPointer(1,2,new GridCell(new RoundFigure())));
        $grid->add(new GridCellPointer(2,2,new GridCell(new EmptyFigure())));

        return $grid;
    }

    private function createGridWithFullVertical()
    {
        $grid = EmptyGridFactory::createForSize(3);
        
        $grid->add(new GridCellPointer(0, 1, new GridCell(new RoundFigure())));
        $grid->add(new GridCellPointer(1, 1, new GridCell(new RoundFigure())));
        $grid->add(new GridCellPointer(2, 1, new GridCell(new RoundFigure())));
        
        $grid->add(new GridCellPointer(1, 2, new GridCell(new CrossFigure())));
        $grid->add(new GridCellPointer(2, 2, new GridCell(new CrossFigure())));

        return $grid;
    }

    private function createGridWithNotFullHorizontal()
    {
        $grid = EmptyGridFactory::createForSize(3);
        $grid->add(new GridCellPointer(0,0,new GridCell(new CrossFigure())));
        $grid->add(new GridCellPointer(0,1,new GridCell(new RoundFigure())));
        $grid->add(new GridCellPointer(0,2,new GridCell(new CrossFigure())));

        $grid->add(new GridCellPointer(1,0,new GridCell(new RoundFigure())));
        $grid->add(new GridCellPointer(1,2,new GridCell(new RoundFigure())));
        $grid->add(new GridCellPointer(2,2,new GridCell(new EmptyFigure())));

        return $grid;
    }

    private function createGridWithNotFullVertical()
    {
        $grid = EmptyGridFactory::createForSize(3);

        $grid->add(new GridCellPointer(0, 1, new GridCell(new RoundFigure())));
        $grid->add(new GridCellPointer(1, 1, new GridCell(new EmptyFigure())));
        $grid->add(new GridCellPointer(2, 1, new GridCell(new RoundFigure())));

        $grid->add(new GridCellPointer(1, 2, new GridCell(new CrossFigure())));
        $grid->add(new GridCellPointer(2, 2, new GridCell(new CrossFigure())));

        return $grid;
    }

    private function createGridWithNotFullDiagonal()
    {
        $grid = EmptyGridFactory::createForSize(3);

        $grid->add(new GridCellPointer(0, 1, new GridCell(new RoundFigure())));
        $grid->add(new GridCellPointer(1, 1, new GridCell(new EmptyFigure())));
        $grid->add(new GridCellPointer(2, 1, new GridCell(new RoundFigure())));

        $grid->add(new GridCellPointer(1, 2, new GridCell(new CrossFigure())));
        $grid->add(new GridCellPointer(2, 2, new GridCell(new CrossFigure())));

        return $grid;
    }

    private function createGridWithFullDiagonal()
    {
        $grid = EmptyGridFactory::createForSize(3);

        $grid->add(new GridCellPointer(0, 0, new GridCell(new RoundFigure())));
        $grid->add(new GridCellPointer(1, 1, new GridCell(new RoundFigure())));
        $grid->add(new GridCellPointer(2, 2, new GridCell(new RoundFigure())));

        $grid->add(new GridCellPointer(1, 2, new GridCell(new CrossFigure())));
        $grid->add(new GridCellPointer(0, 2, new GridCell(new EmptyFigure())));
        $grid->add(new GridCellPointer(2, 0, new GridCell(new CrossFigure())));

        return $grid;
    }
}
