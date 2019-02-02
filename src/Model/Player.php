<?php

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
    private $alignment;

    /**
     * Player constructor.
     * @param string $name
     * @param string $alignment
     */
    public function __construct(string $name, string $alignment)
    {
        $this->setName($name)->setAlignment($alignment);
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
    public function getAlignment(): string
    {
        return $this->alignment;
    }

    /**
     * @param string $alignment
     * @return Player
     */
    public function setAlignment(string $alignment): Player
    {
        $this->alignment = $alignment;
        return $this;
    }
}
