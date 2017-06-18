<?php


use Game\Domain\Grid\EmptyGridFactory;
use Game\Domain\Grid\GridCellCollection;
use Game\Domain\Grid\Validator\GridValidator;
use PHPUnit\Framework\TestCase;

class GridSizeValidatorTest extends TestCase
{

    /**
     * @test
     */
    public function shouldBeOkWithEqualParams()
    {
        $grid = EmptyGridFactory::createForSize(3);
        $validator = new GridValidator(3);

        $this->assertNotFalse($validator->validateSize($grid));
    }

    /**
     * @test
     * @expectedException RuntimeException
     */
    public function shouldThrowExceptionWithDifferentParams()
    {
        $grid = new GridCellCollection(3);
        $validator = new GridValidator(5);

        $this->assertNotFalse($validator->validateSize($grid));
    }
}
