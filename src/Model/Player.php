<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 05/04/18
 * Time: 17:34
 */

namespace Model;


class Player
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $life = 100;
    /**
     * @var array
     */
    private $cards = [];

    /**
     * @return mixed
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Player
     */
    public function setName(sting $name) : Player
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getLife(): int
    {
        return $this->life;
    }

    /**
     * @param int $life
     * @return Player
     */
    public function setLife(int $life): Player
    {
        $this->life = $life;
        return $this;
    }

    /**
     * @return array
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @param array $cards
     * @return Player
     */
    public function setCards(array $cards): Player
    {
        $this->cards = $cards;
        return $this;
    }


}