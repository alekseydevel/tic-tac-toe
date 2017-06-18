<?php
namespace Game\Infrastructure\EventDispatch;

use Game\Infrastructure\Events\GridRedraw;
use Game\Infrastructure\Storage\DataStorage;

class GridSaveEventListener
{
    /**
     * @var DataStorage
     */
    private $storage;

    /**
     * @param DataStorage $storage
     */
    public function __construct(DataStorage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param GridRedraw $gridRedrawEvent
     */
    public function __invoke(GridRedraw $gridRedrawEvent)
    {
        $this->storage->saveGrid($gridRedrawEvent->grid());
    }
}