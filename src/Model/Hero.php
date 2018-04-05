<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 05/04/18
 * Time: 17:27
 */

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
    private $duratbility;
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
     * @var string
     */
    private $race;
    /**
     * @var string
     */
    private $alignement;

    public function __construct(int $id, string $name, int $intelligence, int $strength, int $speed, int $durability, int $power, int $combat, string $gender, string $race, string $alignement)
    {
        $this->setId($id)->setName($name)->setIntelligence($intelligence)->setStrength($strength)->setSpeed($speed)
            ->setDuratbility($durability)->setPower($power)->setCombat($combat)->setGender($gender)->setRace($race)
            ->setAlignement($alignement);
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
    public function getDuratbility(): int
    {
        return $this->duratbility;
    }

    /**
     * @param mixed $duratbility
     * @return Hero
     */
    public function setDuratbility(int $duratbility): Hero
    {
        $this->duratbility = $duratbility;
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
    public function getRace(): string
    {
        return $this->race;
    }

    /**
     * @param mixed $race
     * @return Hero
     */
    public function setRace(string $race): Hero
    {
        $this->race = $race;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlignement(): string
    {
        return $this->alignement;
    }

    /**
     * @param mixed $alignement
     * @return Hero
     */
    public function setAlignement(string $alignement): Hero
    {
        $this->alignement = $alignement;
        return $this;
    }


}