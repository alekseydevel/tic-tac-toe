<?php
namespace Game\Infrastructure\EventDispatch;

use Game\Infrastructure\Events\GridRedraw;
use Game\View\ConsoleRender;

class ConsoleGridEventListener
{
    /**
     * @param GridRedraw $gridRedrawEvent
     */
    public function __invoke(GridRedraw $gridRedrawEvent)
    {
        (new ConsoleRender($gridRedrawEvent->grid(), $gridRedrawEvent->output()))->render();
    }
}