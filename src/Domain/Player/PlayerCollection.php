<?php
namespace Game\Domain\Player;

class PlayerCollection
{
    /**
     * @var array
     */
    private $players;

    public function addPlayer(Player $player)
    {
        $this->checkPlayerRoleUniqueness($player);
        $this->players[] = $player;
    }

    private function checkPlayerRoleUniqueness(Player $player)
    {
        $figureStack = [];

        /** @var Player $player */
        if (isset($figureStack[$player->figure()->type()])) {
            throw new \InvalidArgumentException("Player with type {$player->figure()->type()} is already in app");
        }

        $figureStack[$player->figure()->type()] = true;
    }

    /**
     * @return Player
     */
    public function randomPlayer()
    {
        return $this->players[rand(0, 1)];
    }
}