<?php

interface GameInterface {
    public function __construct(array $gameConfig, array $heroConfig, array $beastConfig);
}
class Game implements GameInterface {
    public function __construct(array $battleConfig, array $heroConfig, array $beastConfig){

        $unitsRandomizer = new UnitsRandomizer;
        $hero = $unitsRandomizer->randomize($heroConfig);
        $beast = $unitsRandomizer->randomize($beastConfig);

        $Orderus  = HeroFactory::make($hero);
        $WildBeast = BeastFactory::make($beast);

        $battle = BattleFactory::create($battleConfig, $Orderus, $WildBeast);
        $battle->startBattle();

    }
}