<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 05/04/18
 * Time: 17:37
 */

namespace Model;


class Fight
{
    const MAX_ROUND = 6;

    /**
     * @var Player
     */
    private $player;
    /**
     * @var Player
     */
    private $cpu;
    /**
     * @var int
     */
    private $round = 0;

    /**
     * Fight constructor.
     * @param Player $player
     * @param Player $cpu
     */
    public function __construct(Player $player, Player $cpu)
    {
        $this->setCpu($cpu)->setPlayer($player);
    }

    public function runRound()
    {
        //TODO
    }

    /**
     * @return mixed
     */
    public function getPlayer() : Player
    {
        return $this->player;
    }

    /**
     * @param mixed $player
     * @return Fight
     */
    public function setPlayer(Player $player) : Fight
    {
        $this->player = $player;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCpu() : Player
    {
        return $this->cpu;
    }

    /**
     * @param mixed $cpu
     * @return Fight
     */
    public function setCpu(Player $cpu) : Fight
    {
        $this->cpu = $cpu;
        return $this;
    }

    /**
     * @return int
     */
    public function getRound() : int
    {
        return $this->round;
    }

    /**
     * @param int $round
     * @return Fight
     */
    public function setRound(int $round) : Fight
    {
        $this->round = $round;
        return $this;
    }


}