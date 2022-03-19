<?php

declare(strict_types=1);

namespace Partnero\Models;

class Transaction extends AbstractModel
{
    /**
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * @var string|null
     */
    protected ?string $key = null;

    /**
     * @var string|null
     */
    protected ?string $action = null;

    /**
     * @var mixed|null
     */
    protected mixed $reward = null;

    /**
     * @var string|null
     */
    protected ?string $rewardUnits = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return $this
     */
    public function setId(?int $id): Transaction
    {
        $this->id = $id;
        return $this;
    }

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
     * @return mixed
     */
    public function getReward(): mixed
    {
        return $this->reward;
    }

    /**
     * @param mixed $reward
     * @return $this
     */
    public function setReward(mixed $reward): Transaction
    {
        $this->reward = $reward;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRewardUnits(): ?string
    {
        return $this->rewardUnits;
    }

    /**
     * @param string|null $rewardUnits
     * @return $this
     */
    public function setRewardUnits(?string $rewardUnits): Transaction
    {
        $this->rewardUnits = $rewardUnits;
        return $this;
    }

    /**
     * @return array
     */
    public function __toArray(): array
    {
        return [
            'id' => $this->getId(),
            'key' => $this->getKey(),
            'reward' => $this->getReward(),
            'action' => $this->getAction(),
            'reward_units' => $this->getRewardUnits(),
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
