<?php

interface AbilityInterface
{
    public function cast(int $damage) : bool;
}
abstract class Ability implements AbilityInterface {
    abstract protected function apply() : int;
}
abstract class ChanceAbility extends Ability {
    protected $title;
    protected $chance;
    protected $damage;
    public function setChance(int $chance) {
        $this->chance = $chance;
    }
    public function getTitle() {
        return $this->title;
    }
    public function cast(int $damage) : bool {
        $this->damage = $damage;
        if($this->chance >= rand(1, 100))
        {
            return true;
        } else return false;
    }
}

final class RapidStrike extends ChanceAbility {
    protected $title = "Rapid Strike";
    protected $chance = 10;
    public function apply() : int {
        $currentDamage = $this->damage;
        $newDamage = $currentDamage*2;
        return $newDamage;
    }
}
final class MagicShield extends ChanceAbility {
    protected $title = "Magic Shield";
    protected $chance = 20;
    public function apply() : int {
        $currentDamage = $this->damage;
        $newDamage = round($currentDamage/2);
        return $newDamage;
    }
}