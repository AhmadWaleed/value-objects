<?php

use AhmadWaleed\ValueObjects\Currency;
use AhmadWaleed\ValueObjects\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    /**
     * @test
     */
    public function copiedMoneyShouldRepresentSameValue()
    {
        $aMoney = new Money(100, new Currency('USD'));
        $copiedMoney = Money::fromMoney($aMoney);
        $this->assertTrue($aMoney->equals($copiedMoney));
    }

    /**
     * @test
     */
    public function originalMoneyShouldNotBeModifiedOnAddition()
    {
        $aMoney = new Money(100, new Currency('USD'));
        $aMoney->add(new Money(20, new Currency('USD')));
        $this->assertEquals(100, $aMoney->getAmount());
    }

    /**
     * @test
     */
    public function moneysShouldBeAdded()
    {
        $aMoney = new Money(100, new Currency('USD'));
        $newMoney = $aMoney->add(new Money(20, new Currency('USD')));
        $this->assertEquals(120, $newMoney->getAmount());
    }
}