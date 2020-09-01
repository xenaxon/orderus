<?php
$heroConfig = Array(
        "name"=>"Orderus",
        "health"=>[70,100],
        "strength"=>[70,80],
        "defence"=>[45,55],
        "speed"=>[40,50],
        "luck"=>[10,30],
        "defence_abilities"=> array(new MagicShield),
        "offense_abilities"=> array(new RapidStrike)
    );
$beastConfig = Array(
        "name"=>"Wild Beast",
        "health"=>[60,90],
        "strength"=>[60,90],
        "defence"=>[40,60],
        "speed"=>[40,60],
        "luck"=>[25,40],
        "defence_abilities"=> array(),
        "offense_abilities"=> array()
    );
$battleConfig = array(
    "rounds"=>20
);