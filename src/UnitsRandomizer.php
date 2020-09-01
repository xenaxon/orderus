<?php

interface UnitsRandomizerInterface
{
    public function randomize($units);
}
final class UnitsRandomizer implements UnitsRandomizerInterface {
    public function randomize($unit){
        if (empty($unit)) throw new InvalidArgumentException();
            foreach ($unit as $statsKey => $statsRange){
                if ($statsKey != "name" && $statsKey != "defence_abilities" && $statsKey != "offense_abilities") {
                    if (!is_array($statsRange) || count($statsRange) != 2) throw new InvalidArgumentException();
                    if ($statsRange[0] > $statsRange[1]) throw new InvalidArgumentException();
                    $unit[$statsKey] = rand($statsRange[0], $statsRange[1]);
                }
            }
        return $unit;
    }
}