<?php
namespace Game\Domain\Player;

use Game\Domain\Figure\CrossFigure;
use Game\Domain\Figure\RoundFigure;

class PlayerCollectionFactory
{
    public static function createWithTwoDifferentPlayers()
    {
        $players = new PlayerCollection();
        $players->addPlayer(new Player(new CrossFigure()));
        $players->addPlayer(new Player(new RoundFigure()));

        return $players;
    }
}