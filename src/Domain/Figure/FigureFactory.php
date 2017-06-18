<?php
namespace Game\Domain\Figure;

use Game\Domain\Figure\CrossFigure;
use Game\Domain\Figure\EmptyFigure;
use Game\Domain\Figure\RoundFigure;

class FigureFactory
{
    private static $figuresMap = [
        'X' => CrossFigure::class,
        '0' => RoundFigure::class
    ];

    public static function fromFigureRepresentation($symbol)
    {
        if (!isset(self::$figuresMap[$symbol])) {
            return new EmptyFigure();
        }

        return new self::$figuresMap[$symbol];
    }
}