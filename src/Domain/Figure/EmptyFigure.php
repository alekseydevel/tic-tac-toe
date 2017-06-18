<?php
namespace Game\Domain\Figure;

class EmptyFigure implements Figure
{
    public function type()
    {
        return '';
    }
}