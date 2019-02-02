<?php

namespace Model;

class Hero
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $intelligence;

    /**
     * @var int
     */
    private $strength;

    /**
     * @var int
     */
    private $speed;

    /**
     * @var int
     */
    private $durability;

    /**
     * @var int
     */
    private $power;

    /**
     * @var int
     */
    private $combat;

    /**
     * @var int
     */
    private $gender;

    /**
     * @var ?string
     */
    private $race;

    /**
     * @var string
     */
    private $alignment;
    
    /**
     * @var string
     */
    private $photo;

    /**
     * Hero constructor.
     * @param int $id
     * @param string $name
     * @param int $intelligence
     * @param int $strength
     * @param int $speed
     * @param int $durability
     * @param int $power
     * @param int $combat
     * @param string $gender
     * @param string|null $race
     * @param string $alignment
     * @param string $photo
     */
    public function __construct(
        int $id,
        string $name,
        int $intelligence,
        int $strength,
        int $speed,
        int $durability,
        int $power,
        int $combat,
        string $gender,
        ?string $race,
        string $alignment,
        string $photo
    ) {
        $this->setId($id)->setName($name)->setIntelligence($intelligence)->setStrength($strength)->setSpeed($speed)
            ->setDurability($durability)->setPower($power)->setCombat($combat)->setGender($gender)->setRace($race)
            ->setAlignment($alignment)->setPhoto($photo);
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Hero
     */
    public function setId(int $id): Hero
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Hero
     */
    public function setName(string $name): Hero
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIntelligence(): int
    {
        return $this->intelligence;
    }

    /**
     * @param mixed $intelligence
     * @return Hero
     */
    public function setIntelligence(int $intelligence): Hero
    {
        $this->intelligence = $intelligence;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param mixed $strength
     * @return Hero
     */
    public function setStrength(int $strength): Hero
    {
        $this->strength = $strength;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     * @return Hero
     */
    public function setSpeed(int $speed): Hero
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDurability(): int
    {
        return $this->durability;
    }

    /**
     * @param int $durability
     * @return Hero
     */
    public function setDurability(int $durability): Hero
    {
        $this->durability = $durability;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPower(): int
    {
        return $this->power;
    }

    /**
     * @param mixed $power
     * @return Hero
     */
    public function setPower(int $power): Hero
    {
        $this->power = $power;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCombat(): int
    {
        return $this->combat;
    }

    /**
     * @param mixed $combat
     * @return Hero
     */
    public function setCombat(int $combat): Hero
    {
        $this->combat = $combat;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     * @return Hero
     */
    public function setGender(string $gender): Hero
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRace(): ?string
    {
        return $this->race;
    }

    /**
     * @param mixed $race
     * @return Hero
     */
    public function setRace(?string $race): Hero
    {
        $this->race = $race;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlignment(): string
    {
        return $this->alignment;
    }

    /**
     * @param string $alignment
     * @return Hero
     */
    public function setAlignment(string $alignment): Hero
    {
        $this->alignment = $alignment;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     * @return Hero
     */
    public function setPhoto(string $photo): Hero
    {
        $this->photo = $photo;
        return $this;
    }
}
