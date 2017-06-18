<?php
namespace Game\Infrastructure\EventDispatch;

use Game\Domain\Conditions\GridFinishedCondition;
use Game\Infrastructure\Events\GridRedraw;

class GridFinishListener
{
    public function __invoke(GridRedraw $gridRedraw)
    {
        $condition = new GridFinishedCondition($gridRedraw->grid());

        if ($condition->isSatisfied()) {
            $gridRedraw->output()->writeln(
                sprintf("\n\n!!!!!\n\nSuccess\n\n!!!!!\n\n")
            );
        }
    }

}