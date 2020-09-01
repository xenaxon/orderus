<?php

interface BattleInterface {
    public function addHero(Unit $hero);
    public function addBeast(Unit $beast);
    public function startBattle();
}
class BattleFactory
{
    public static function create(array $config, Unit $hero, Unit $beast) {
        return (new Battle($config))->addHero($hero)->addBeast($beast);
    }
}
class Battle implements BattleInterface {

    private $rounds = 5;
    private $battleRound = null;
    private $attacker = null;
    private $defender = null;
    private $hero = null;
    private $beast = null;
    private $battleWinner = null;
    private $battleLooser = null;

    public function __construct($config) {
        $this->rounds = $config["rounds"];
    }

    public function addHero(Unit $hero) {
        $this->hero = $hero;
        return $this;
    }

    public function addBeast(Unit $beast) {
        $this->beast = $beast;
        return $this;
    }

    public function getHero() {
        return $this->hero;
    }

    public function getBeast() {
        return $this->beast;
    }

    public function getAttacker() {
        return $this->attacker;
    }

    public function getDefender() {
        return $this->defender;
    }

    public function startBattle() {
        $this->calculateWhoAttacksFirst();

        for($round = 1; $round <= $this->rounds; $round++) {
            $this->battleRound = $round;

            if($this->hasBattleEnded() === true)
                break;

            $this->playRound($round);
            echo "The round has ended.<br />";
        }
        $this->announceWinner();
    }

    private function playRound(int $round) {

        $damage = $this->calculateDamage();
        $newDamage = $damage;

        echo "<br /><b>".$this->attacker->getName() . "</b> attacks. ";
        $newDamage = $this->castAbilities($this->attacker->getOffenseAbilities(),$newDamage);

        echo "<br /><b>".$this->defender->getName() . "</b> defends. ";
        $newDamage = $this->castAbilities($this->defender->getDefenceAbilities(),$newDamage);

        if($this->defender->getLuck() >= rand(1, 100))
        {
            echo "<b>".$this->defender->getName() . "</b> got lucky and avoided a $newDamage damage hit from ". $this->attacker->getName()."</b><br />";
            $damage = 0;
        } else echo "<b>".$this->defender->getName() . "</b> took $newDamage damage from ". "<b>".$this->attacker->getName()."</b> and now has ".$this->defender->getHealth()." health left.<br />";

        $newHealth = $this->defender->getHealth() - $newDamage;

        if($newHealth < 0)
            $newHealth = 0;

        $this->defender->setHealth($newHealth);
        $this->switchRoles();
    }

    private function hasBattleEnded() {
        if($this->defender->getHealth() == 0 || $this->attacker->getHealth() == 0)
            return true;

        return false;
    }

    private function calculateWhoAttacksFirst() {
        if($this->hero->getSpeed() > $this->beast->getSpeed()) {
            $this->attacker = $this->hero;
            $this->defender = $this->beast;
        } else if($this->hero->getSpeed() < $this->beast->getSpeed()) {
            $this->attacker = $this->beast;
            $this->defender = $this->hero;
        }
        else if($this->hero->getLuck() > $this->beast->getLuck()) {
            $this->attacker = $this->hero;
            $this->defender = $this->beast;
        }
        else if($this->hero->getLuck() < $this->beast->getLuck()) {
            $this->attacker = $this->beast;
            $this->defender = $this->hero;
        }
        else {
            $this->attacker = $this->hero;
            $this->defender = $this->beast;
        }
        return false;
    }

    private function calculateDamage() {
        $damage = 0;

        if($this->attacker->getStrength() > $this->defender->getDefence())
            return $this->attacker->getStrength() - $this->defender->getDefence();

        return $damage;
    }
    private function castAbilities($abilities, $damage) {
        $newDamage = $damage;

        foreach($abilities as $key => $ability) {
            $castSuccessful = $ability->cast($damage);
            if ($castSuccessful) {
                $newDamage = $ability->apply();
                echo "He uses the ".$ability->getTitle()." ability. ";
            }
        }

        return $newDamage;
    }

    private function switchRoles() {
        $lastAttacker = $this->attacker;
        $this->attacker = $this->defender;
        $this->defender = $lastAttacker;
    }

    public function announceWinner() {
        if($this->attacker->getHealth() > $this->defender->getHealth()) {
            $this->battleWinner = $this->attacker;
            $this->battleLooser = $this->defender;
        }
        else {
            $this->battleWinner = $this->defender;
            $this->battleLooser = $this->attacker;
        }

        echo "<br /><b>".$this->battleWinner->getName() . "</b> has won the game with ".$this->battleWinner->getHealth(). " health left, defeating ".
             "<b>".$this->battleLooser->getName() . "</b> ".($this->battleLooser->getHealth()==0 ? "that has died in combat.": "that has ".$this->battleLooser->getHealth()." health left")."<br />";
        echo "The battle has ended. </br >";
    }
}