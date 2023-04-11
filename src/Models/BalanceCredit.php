<?php

declare(strict_types=1);

namespace Partnero\Models;

class BalanceCredit extends AbstractModel
{
    /**
     * @var float|null
     */
    protected ?float $amount = null;

    /**
     * @var string|null
     */
    protected ?string $amountUnits = null;

    /**
     * @var bool|null
     */
    protected ?bool $isCurrency = null;

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float|null $amount
     * @return $this
     */
    public function setAmount(?float $amount): BalanceCredit
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAmountUnits(): ?string
    {
        return $this->amountUnits;
    }

    /**
     * @param string|null $amountUnits
     * @return $this
     */
    public function setAmountUnits(?string $amountUnits): BalanceCredit
    {
        $this->amountUnits = $amountUnits;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsCurrency(): ?bool
    {
        return $this->isCurrency;
    }

    /**
     * @param bool|null $isCurrency
     * @return $this
     */
    public function setIsCurrency(?bool $isCurrency): BalanceCredit
    {
        $this->isCurrency = $isCurrency;
        return $this;
    }

    /**
     * @return string[]
     */
    public function __toArray(): array
    {
        return [
            'amount' => $this->getAmount(),
            'amount_units' => $this->getAmountUnits(),
            'is_currency' => $this->getIsCurrency(),
        ];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return '';
    }
}
