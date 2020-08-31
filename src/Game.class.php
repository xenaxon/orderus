<?php

interface GameInterface {
    public function __construct(array $gameConfig, array $unitsConfig);
}
class Game implements GameInterface {
    public function __construct(array $battleConfig, array $unitsConfig){

        $unitsRandomizer = new UnitsRandomizer;
        $units = $unitsRandomizer->randomize($unitsConfig);

        $Orderus  = HeroFactory::make($units["Hero"]);
        $WildBeast = BeastFactory::make($units["Beast"]);

        $battle = BattleFactory::create($battleConfig, $Orderus, $WildBeast);
        $battle->startBattle();

    }
}