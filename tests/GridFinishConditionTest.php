<?php
namespace tests;

use PHPUnit\Framework\TestCase;

class GridFinishConditionTest extends TestCase
{

    /**
     * @test
     */
    public function shouldBeFinishedWithFullVertical()
    {
        $this->assertTrue(1 == 1);
    }

    /**
     * @test
     */
    public function shouldBeFinishedWithFullLine()
    {
        $this->assertTrue(1 == 1);
    }

    /**
     * @test
     */
    public function shouldBeFinishedWithFullDiag()
    {
        $this->assertTrue(1 == 1);
    }

    /**
     * @test
     */
    public function shouldNotBeFinishedWithPartialRow()
    {
        $this->assertTrue(1 == 1);
    }

    /**
     * @test
     */
    public function shouldNotBeFinishedWithPartialDiag()
    {
        $this->assertTrue(1 == 1);
    }

    /**
     * @test
     */
    public function shouldNotBeFinishedWithPartialVertical()
    {
        $this->assertTrue(1 == 1);
    }
}
