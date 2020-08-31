<?php
interface EntityFactory
{
static function make(array $stats);
}

interface Entity
{
public function getType() : string;
public function getName() : string;
}

abstract class Unit implements Entity {
    protected  $type;
    protected  $name;
    protected  $health;
    protected  $strength;
    protected  $defence;
    protected  $speed;
    protected  $luck;
    protected  $defenseAbilities;
    protected  $offenseAbilities;

    public function __construct(array $stats) {
        $this->name = $stats["name"];
        $this->health = $stats["health"];
        $this->strength = $stats["strength"];
        $this->defence = $stats["defence"];
        $this->speed = $stats["speed"];
        $this->luck = $stats["luck"];
        $this->defenceAbilities = $stats["defence_abilities"];
        $this->offenseAbilities = $stats["offense_abilities"];
    }
    public function getDefenceAbilities(){
        return $this->defenceAbilities;
    }
    public function getOffenseAbilities(){
        return $this->offenseAbilities;
    }
    public function getType() : string {
        return $this->type;
    }
    public function getName() : string {
        return $this->name;
    }
    public function setHealth($newHealth) : bool {
        $this->health = $newHealth;
        return true;
    }
    public function getHealth() : int {
        return $this->health;
    }
    public function getStrength() : int {
        return $this->strength;
    }
    public function getDefence() : int {
        return $this->defence;
    }
    public function getSpeed() : int {
        return $this->speed;
    }
    public function getLuck() : int {
        return $this->luck;
    }
}

class HeroFactory implements EntityFactory
{
    static function make(array $stats)
    {
        return new Hero($stats);
    }
}

class BeastFactory implements EntityFactory
{
    static function make($stats)
    {
        return new Beast($stats);
    }
}

final class Beast extends Unit
{
    protected $type = "Wild Beast";
}

final class Hero extends Unit
{
    protected $type = "Hero";
}