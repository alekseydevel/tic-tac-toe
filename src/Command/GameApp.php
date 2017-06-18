<?php
namespace Game\Command;

use Game\Domain\Grid\Validator\GridValidator;
use Game\Domain\Grid\GridCellCollection;
use Game\Domain\Player\PlayerCollectionFactory;
use Game\Domain\Player\PlayerCollection;
use Game\Infrastructure\Events\Events;
use Game\Infrastructure\EventDispatch\ConsoleGridEventDispatcher;
use Game\Infrastructure\EventDispatch\ConsoleGridEventListener;
use Game\Infrastructure\EventDispatch\GridSaveEventListener;
use Game\Infrastructure\EventDispatch\GridFinishListener;
use Game\Infrastructure\Storage\DataStorage;
use Symfony\Component\Console\Application;

class GameApp extends Application
{

    /** @var  GridCellCollection */
    private $grid;

    /** @var  PlayerCollection */
    private $players;

    /** @var  ConsoleGridEventDispatcher */
    private $consoleDispatcher;

    /** @var DataStorage */
    private $storage;

    public function __construct(DataStorage $storage, $name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);

        $this->storage = $storage;
        $this->init();
    }

    private function init()
    {
        $this->players = PlayerCollectionFactory::createWithTwoDifferentPlayers();
        $this->grid = $this->storage()->fetchGrid();
        $this->initDispatcher();

        $this->add(new StartApp());
        $this->add(new PlaceTheObject());
        $this->add(new TerminateApp());
    }

    private function initDispatcher()
    {
        $this->consoleDispatcher = new ConsoleGridEventDispatcher($this->grid());
        $this->consoleDispatcher->addListener(
            Events::GRID_CHANGED,
            new GridSaveEventListener($this->storage),
            20
        );
        $this->consoleDispatcher->addListener(
            Events::GRID_CHANGED,
            new ConsoleGridEventListener(),
            10
        );
        $this->consoleDispatcher->addListener(
            Events::GRID_CHANGED,
            new GridFinishListener(),
            5
        );
    }

    /** @return ConsoleGridEventDispatcher */
    public function gameDispatcher()
    {
        return $this->consoleDispatcher;
    }

    /** @return DataStorage */
    public function storage()
    {
        return $this->storage;
    }

    /**
     * @return GridCellCollection
     */
    public function grid()
    {
        if (!$this->grid) {
            throw new \RuntimeException("Empty grid. Please, run game:start command");
        }

        (new GridValidator($this->grid->sideSize()))->validateSize($this->grid);

        return $this->grid;
    }

    public function setGrid(GridCellCollection $grid)
    {
        $this->grid = $grid;
    }

    public function players()
    {
        return $this->players;
    }

    public function terminate()
    {
        $this->grid->clear();
        $this->storage->clear();
    }
}