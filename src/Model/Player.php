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
    private $heroes = [];

    /**
     * @var string
     */
    private $alignement;


    public function __construct(string $name, string $alignement)
    {
        $this->setName($name)->setAlignement($alignement);
    }

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
    public function setName(string $name) : Player
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
    public function getHeroes(): array
    {
        return $this->heroes;
    }

    /**
     * @param array $heroes
     * @return Player
     */
    public function setHeroes(array $heroes): Player
    {
        $this->heroes = $heroes;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlignement(): string
    {
        return $this->alignement;
    }

    /**
     * @param string $alignement
     * @return Player
     */
    public function setAlignement(string $alignement): Player
    {
        $this->alignement = $alignement;
        return $this;
    }


}