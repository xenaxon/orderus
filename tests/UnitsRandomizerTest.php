<?php
use PHPUnit\Framework\TestCase;

final class UnitsRandomizerTest extends TestCase
{
    public function testStatsArrayEmpty()
    {
        $this->expectException(InvalidArgumentException::class);

        $unitConfig = [];
        $unitsGenerator = new UnitsRandomizer();
        $unitsGenerator->randomize($unitConfig);
    }
    public function testStatsRangeNotGiven()
    {
        $this->expectException(InvalidArgumentException::class);

        $unitsConfig = [
            "health"=>60
        ];
        $unitsGenerator = new UnitsRandomizer();
        $unitsGenerator->randomize($unitsConfig);
    }
    public function testStatsRangeInvalid()
    {
        $this->expectException(InvalidArgumentException::class);

        $unitsConfig = [
            "health"=>[50, 40]
        ];
        $unitsGenerator = new UnitsRandomizer();
        $unitsGenerator->randomize($unitsConfig);
    }
}