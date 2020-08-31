<?php

interface UnitsRandomizerInterface
{
    public function randomize($units);
}
final class UnitsRandomizer implements UnitsRandomizerInterface {
    private $units;
    public function randomize($units){
        $this->units = $units;
        foreach ($units as $key => $unit) {
            foreach ($unit as $statsKey => $statsRange){
                if ($statsKey != "name" && $statsKey != "defence_abilities" && $statsKey != "offense_abilities") {
                    $this->units[$key][$statsKey] = rand($statsRange[0], $statsRange[1]);
                }
            }
        }
        return $this->units;
    }
}