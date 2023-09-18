<?php

declare(strict_types=1);

namespace Partnero\Models;

class Transaction extends AbstractModel
{
    /**
     * @var string|null
     */
    protected ?string $key = null;

    /**
     * @var string|null
     */
    protected ?string $action = null;

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
    protected ?bool $rewardable = null;

    /**
     * @var bool|null
     */
    protected ?bool $rewarded = null;

    /**
     * @var string|null
     */
    protected ?string $status = null;

    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     * @return $this
     */
    public function setKey(?string $key): Transaction
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * @param string|null $action
     * @return $this
     */
    public function setAction(?string $action): Transaction
    {
        $this->action = $action;
        return $this;
    }

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
    public function setAmount(?float $amount): Transaction
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
     * @deprecated
     */
    public function setAmountUnits(?string $amountUnits): Transaction
    {
        $this->amountUnits = $amountUnits;
        return $this;
    }

    /**
     * @return float|null
     * @deprecated use getAmount()
     */
    public function getReward(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float|null $reward
     * @return $this
     * @deprecated use setAmount()
     */
    public function setReward(?float $reward): Transaction
    {
        $this->amount = $reward;
        return $this;
    }

    /**
     * @return string|null
     * @deprecated
     */
    public function getRewardUnits(): ?string
    {
        return $this->amountUnits;
    }

    /**
     * @param string|null $rewardUnits
     * @return $this
     * @deprecated
     */
    public function setRewardUnits(?string $rewardUnits): Transaction
    {
        $this->amountUnits = $rewardUnits;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getRewardable(): ?bool
    {
        return $this->rewardable;
    }

    /**
     * @param bool|null $rewardable
     * @return $this
     */
    public function setRewardable(?bool $rewardable): Transaction
    {
        $this->rewardable = $rewardable;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getRewarded(): ?bool
    {
        return $this->rewarded;
    }

    /**
     * @param bool|null $rewarded
     * @return $this
     */
    public function setRewarded(?bool $rewarded): Transaction
    {
        $this->rewarded = $rewarded;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return $this
     */
    public function setStatus(?string $status): Transaction
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return array
     */
    public function __toArray(): array
    {
        return [
            'key' => $this->getKey(),
            'amount' => $this->getAmount(),
            'amount_units' => $this->getAmountUnits(),
            'action' => $this->getAction(),
            'status' => $this->getStatus(),
            'rewarded' => $this->getRewarded(),
            'rewardable' => $this->getRewardable()
        ];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->getKey();
    }
}
