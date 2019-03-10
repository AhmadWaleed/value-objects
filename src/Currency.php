<?php

namespace AhmadWaleed\ValueObjects;

class Currency
{
    /** @var string $isoCode */
    private $isoCode;

    /**
     * Currency constructor
     *
     * @param string $anIsoCode
     */
    public function __construct(string $anIsoCode)
    {
        $this->setIsoCode($anIsoCode);
    }

    /**
     * Currency setter
     *
     * @param string $anIsoCode
     *
     * @return void
     */
    public function setIsoCode(string $anIsoCode): void
    {
        if (! preg_match('/^[A-Z]{3}$/', $anIsoCode)) {
            throw new \InvalidArgumentException();
        }

        $this->isoCode = $anIsoCode;
    }

    /**
     * Currency getter
     *
     * @return string
     */
    public function getIsoCode(): string
    {
        return $this->isoCode;
    }

    /**
     * compare two currencies are equals
     *
     * @param Currency $currency
     *
     * @return bool
     */
    public function equals(Currency $currency): bool
    {
        return $this->isoCode === $currency->getIsoCode();
    }
}
