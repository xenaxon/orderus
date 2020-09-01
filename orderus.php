<?php

require "vendor/autoload.php";
require "src/Game.php";
require "src/Entity.php";
require "src/Ability.php";
require "src/Battle.php";
require "src/UnitsRandomizer.php";
require "config.php";

$game = new Game($battleConfig,$heroConfig, $beastConfig);