<?php

declare(strict_types=1);

namespace Partnero\Models;

class Coupon extends AbstractModel
{
    /**
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * @var string|null
     */
    protected ?string $uuidCode = null;

    /**
     * @var bool|null
     */
    protected ?bool $active = null;

    /**
     * @var string|null
     */
    protected ?string $couponDiscountType = null;

    /**
     * @var int|float|null
     */
    protected int|float|null $couponDiscountAmount = null;

    /**
     * @var string|null
     */
    protected ?string $couponDurationType = null;

    /**
     * @var int|null
     */
    protected int|null $couponDurationValue = null;

    /**
     * @var bool|null
     */
    protected ?bool $redemptionSpecificDateStatus = null;

    /**
     * @var string|null
     */
    protected ?string $redemptionSpecificDateValue = null;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param  string|null $name
     * @return $this
     */
    public function setName(?string $name): Coupon
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUuidCode(): ?string
    {
        return $this->uuidCode;
    }

    /**
     * @param  string|null $uuidCode
     * @return $this
     */
    public function setUuidCode(?string $uuidCode): Coupon
    {
        $this->uuidCode = $uuidCode;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param  bool|null $active
     * @return $this
     */
    public function setActive(?bool $active): Coupon
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCouponDiscountType(): ?string
    {
        return $this->couponDiscountType;
    }

    /**
     * @param  string|null $couponDiscountType
     * @return $this
     */
    public function setCouponDiscountType(?string $couponDiscountType): Coupon
    {
        $this->couponDiscountType = $couponDiscountType;
        return $this;
    }

    /**
     * @return int|float|null
     */
    public function getCouponDiscountAmount(): int|float|null
    {
        return $this->couponDiscountAmount;
    }

    /**
     * @param  int|float|null $couponDiscountAmount
     * @return $this
     */
    public function setCouponDiscountAmount(int|float|null $couponDiscountAmount): Coupon
    {
        $this->couponDiscountAmount = $couponDiscountAmount;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCouponDurationType(): ?string
    {
        return $this->couponDurationType;
    }

    /**
     * @param  string|null $couponDurationType
     * @return $this
     */
    public function setCouponDurationType(?string $couponDurationType): Coupon
    {
        $this->couponDurationType = $couponDurationType;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCouponDurationValue(): int|null
    {
        return $this->couponDurationValue;
    }

    /**
     * @param  int|null $couponDurationValue
     * @return $this
     */
    public function setCouponDurationValue(int|null $couponDurationValue): Coupon
    {
        $this->couponDurationValue = $couponDurationValue;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getRedemptionSpecificDateStatus(): ?bool
    {
        return $this->redemptionSpecificDateStatus;
    }

    /**
     * @param  bool|null $redemptionSpecificDateStatus
     * @return $this
     */
    public function setRedemptionSpecificDateStatus(?bool $redemptionSpecificDateStatus): Coupon
    {
        $this->redemptionSpecificDateStatus = $redemptionSpecificDateStatus;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRedemptionSpecificDateValue(): ?string
    {
        return $this->redemptionSpecificDateValue;
    }

    /**
     * @param  string|null $redemptionSpecificDateValue
     * @return $this
     */
    public function setRedemptionSpecificDateValue(?string $redemptionSpecificDateValue): Coupon
    {
        $this->redemptionSpecificDateValue = $redemptionSpecificDateValue;
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
    public function setRedemptionTimesStatus(?bool $redemptionTimesStatus): Coupon
    {
        $this->redemptionTimesStatus = $redemptionTimesStatus;
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
    public function setRedemptionTimesValue(int|null $redemptionTimesValue): Coupon
    {
        $this->redemptionTimesValue = $redemptionTimesValue;
        return $this;
    }

    /**
     * @return string[]
     */
    public function __toArray(): array
    {
        return [
            'name' => $this->getName(),
            'uuid_code' => $this->getUuidCode(),
            'active' => $this->getActive(),
            'coupon_discount_type' => $this->getCouponDiscountType(),
            'coupon_discount_amount' => $this->getCouponDiscountAmount(),
            'coupon_duration_type' => $this->getCouponDurationType(),
            'coupon_duration_value' => $this->getCouponDurationValue(),
            'redemption_specific_date_status' => $this->getRedemptionSpecificDateStatus(),
            'redemption_specific_date_value' => $this->getRedemptionSpecificDateValue(),
            'redemption_times_status' => $this->getRedemptionTimesStatus(),
            'redemption_times_value' => $this->getRedemptionTimesValue(),
            'promotion_codes',
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
