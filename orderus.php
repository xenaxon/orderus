<?php

require "vendor/autoload.php";
require "src/Game.class.php";
require "src/Entity.class.php";
require "src/Ability.class.php";
require "src/Battle.class.php";
require "src/UnitsRandomizer.class.php";
require "config.php";

$game = new Game($battleConfig,$unitsConfig);