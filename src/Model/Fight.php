<?php

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
     * @var array
     */
    private $attakType = ['intelligence', 'strength', 'speed', 'durability', 'power', 'combat'];

    /**
     * Fight constructor.
     * @param Player $player
     * @param Player $cpu
     */
    public function __construct(Player $player, Player $cpu)
    {
        $this->setCpu($cpu)->setPlayer($player);
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

    /**
     * @return array
     */
    public function getAttaksType(): array
    {
        return $this->attakType;
    }

    /**
     * @param array $attakType
     * @return Fight
     */
    public function setAttakType(array $attakType): Fight
    {
        $this->attakType = $attakType;
        return $this;
    }
}
