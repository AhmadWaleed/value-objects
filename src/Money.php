<?php

namespace AhmadWaleed\ValueObjects;

use http\Exception\InvalidArgumentException;

class Money
{
    /** @var int $amount */
    private $amount;

    /** @var Currency $currency */
    private $currency;

    /**
     * Money constructor.
     *
     * @param int $anAmount
     * @param Currency $aCurrency
     */
    public function __construct(int $anAmount, Currency $aCurrency)
    {
        $this->setAmount($anAmount);
        $this->setCurrency($aCurrency);
    }

    /**
     * get immutable copy of money object
     *
     * @param Money $aMoney
     *
     * @return Money
     */
    public static function fromMoney(Money $aMoney)
    {
        return new self($aMoney->getAmount(), $aMoney->getCurrency());
    }

    /**
     * get immutable copy of money object from given currency
     *
     * @param Currency $aCurrency
     *
     * @return Money
     */
    public static function fromCurrency(Currency $aCurrency)
    {
        return new self(0, $aCurrency);
    }

    /**
     * get  new immutable with increased amount
     *
     * @param int $anAmount
     *
     * @return Money
     */
    public function increaseAmountBy(int $anAmount)
    {
        return new self($this->getAmount() + $anAmount, $this->getCurrency());
    }

    /**
     * amount setter
     *
     * @param mixed $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * currency setter
     *
     * @param mixed $currency
     */
    public function setCurrency($currency): void
    {
        $this->currency = $currency;
    }

    /**
     * amount getter
     *
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * currency getter
     *
     * get currency object
     *
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * compare two money objects are equals
     *
     * @param Money $money
     *
     * @return bool
     */
    public function equals(Money $money): bool
    {
        return $money->getCurrency()->equals($this->getCurrency()) &&
            $money->getAmount() === $this->getAmount();
    }

    /**
     * add money with same currency
     *
     * @param Money $money
     *
     * @return Money
     */
    public function add(Money $money): Money
    {
        if (! $money->getCurrency()->equals($this->getCurrency())) {
            throw new InvalidArgumentException();
        }

        return new self($this->getAmount() + $money->getAmount(), $this->getCurrency());
    }
}
