<?php

use PHPUnit\Framework\TestCase;

final class AbilityTest extends TestCase
{
    public function testChanceIsValid()
    {
        $this->expectException(InvalidArgumentException::class);

        $ability = new RapidStrike();
        $ability->setChance(100);
        $ability->setChance(0);
    }
}