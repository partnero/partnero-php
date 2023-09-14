<?php

declare(strict_types=1);

namespace Partnero\Models;

class PromotionCode extends AbstractModel
{
    /**
     * @var string|null
     */
    protected ?string $code = null;

    /**
     * @var bool|null
     */
    protected ?bool $firstTimeOrder = null;

    /**
     * @var bool|null
     */
    protected ?bool $limitToSpecificPartner = null;

    /**
     * @var bool|null
     */
    protected ?bool $limitToSpecificCustomer = null;

    /**
     * @var bool|null
     */
    protected ?bool $minimumOrderStatus = null;

    /**
     * @var int|null
     */
    protected ?int $minimumOrderValue = null;

    /**
     * @var bool|null
     */
    protected ?bool $expirationDateStatus = null;

    /**
     * @var string|null
     */
    protected ?string $expirationDateValue = null;

    /**
     * @var bool|null
     */
    protected ?bool $redemptionTimesStatus = null;

    /**
     * @var int|null
     */
    protected ?int $redemptionTimesValue = null;

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param  string|null $code
     * @return $this
     */
    public function setCode(?string $code): PromotionCode
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getFirstTimeOrder(): ?bool
    {
        return $this->firstTimeOrder;
    }

    /**
     * @param  bool|null $firstTimeOrder
     * @return $this
     */
    public function setFirstTimeOrder(?bool $firstTimeOrder): PromotionCode
    {
        $this->firstTimeOrder = $firstTimeOrder;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getLimitToSpecificPartner(): ?bool
    {
        return $this->limitToSpecificPartner;
    }

    /**
     * @param  bool|null $limitToSpecificPartner
     * @return $this
     */
    public function setLimitToSpecificPartner(?bool $limitToSpecificPartner): PromotionCode
    {
        $this->limitToSpecificPartner = $limitToSpecificPartner;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getLimitToSpecificCustomer(): ?bool
    {
        return $this->limitToSpecificCustomer;
    }

    /**
     * @param  bool|null $limitToSpecificCustomer
     * @return $this
     */
    public function setLimitToSpecificCustomer(?bool $limitToSpecificCustomer): PromotionCode
    {
        $this->limitToSpecificCustomer = $limitToSpecificCustomer;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getMinimumOrderStatus(): ?bool
    {
        return $this->minimumOrderStatus;
    }

    /**
     * @param  bool|null $minimumOrderStatus
     * @return $this
     */
    public function setMinimumOrderStatus(?bool $minimumOrderStatus): PromotionCode
    {
        $this->minimumOrderStatus = $minimumOrderStatus;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRedemptionTimesValue(): int|null
    {
        return $this->redemptionTimesValue;
    }

    /**
     * @param  int|null $redemptionTimesValue
     * @return $this
     */
    public function setRedemptionTimesValue(int|null $redemptionTimesValue): PromotionCode
    {
        $this->redemptionTimesValue = $redemptionTimesValue;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getExpirationDateStatus(): ?bool
    {
        return $this->expirationDateStatus;
    }

    /**
     * @param  bool|null $expirationDateStatus
     * @return $this
     */
    public function setExpirationDateStatus(?bool $expirationDateStatus): PromotionCode
    {
        $this->expirationDateStatus = $expirationDateStatus;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExpirationDateValue(): ?string
    {
        return $this->expirationDateValue;
    }

    /**
     * @param  string|null $expirationDateValue
     * @return $this
     */
    public function setExpirationDateValue(?string $expirationDateValue): PromotionCode
    {
        $this->expirationDateValue = $expirationDateValue;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getRedemptionTimesStatus(): ?bool
    {
        return $this->redemptionTimesStatus;
    }

    /**
     * @param  bool|null $redemptionTimesStatus
     * @return $this
     */
    public function setRedemptionTimesStatus(?bool $redemptionTimesStatus): PromotionCode
    {
        $this->redemptionTimesStatus = $redemptionTimesStatus;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinimumOrderValue(): int|null
    {
        return $this->minimumOrderValue;
    }

    /**
     * @param  int|null $minimumOrderValue
     * @return $this
     */
    public function setMinimumOrderValue(int|null $minimumOrderValue): PromotionCode
    {
        $this->minimumOrderValue = $minimumOrderValue;
        return $this;
    }

    /**
     * @return string[]
     */
    public function __toArray(): array
    {
        return [
            'code' => $this->getCode(),
            'first_time_order' => $this->getFirstTimeOrder(),
            'limit_to_specific_partner' => $this->getLimitToSpecificPartner(),
            'coupon_specific_partners',
            'limit_to_specific_customer' => $this->getLimitToSpecificCustomer(),
            'coupon_specific_customers',
            'minimum_order_status' => $this->getMinimumOrderStatus(),
            'minimum_order_value' => $this->getMinimumOrderValue(),
            'expiration_date_status' => $this->getExpirationDateStatus(),
            'expiration_date_value' => $this->getExpirationDateValue(),
            'redemption_times_status' => $this->getRedemptionTimesStatus(),
            'redemption_times_value' => $this->getRedemptionTimesValue(),
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
