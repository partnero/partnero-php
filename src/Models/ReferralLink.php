<?php

declare(strict_types=1);

namespace Partnero\Models;

class ReferralLink extends AbstractModel
{
    /**
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * This is public identifier
     * For unique identifier use $id
     *
     * @var string|null
     */
    protected ?string $key = null;

    /**
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * @var bool|null
     */
    protected ?bool $default = null;

    /**
     * @var bool|null
     */
    protected ?bool $isAdditional = null;

    /**
     * @var bool|null
     */
    protected ?bool $directTracking = null;

    /**
     * @var bool|null
     */
    protected ?bool $directTrackingRedirect = null;

    /**
     * @var string|null
     */
    protected ?string $directTrackingRedirectUrl = null;

    /**
     * @return string|null
     */
    public function getId(): string|null
    {
        return $this->id;
    }

    /**
     * @param  string|null $id
     * @return $this
     */
    public function setId(string|null $id): ReferralLink
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
     * This is for public identifier
     * For unique identifier use setId
     *
     * @param string|null $key
     * @return $this
     */
    public function setKey(?string $key): ReferralLink
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * @return $this
     */
    public function setUrl(?string $url): ReferralLink
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDefault(): ?bool
    {
        return $this->default;
    }

    /**
     * @param bool|null $default
     * @return $this
     */
    public function setDefault(?bool $default): ReferralLink
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsAdditional(): ?bool
    {
        return $this->isAdditional;
    }

    /**
     * @param bool|null $isAdditional
     * @return $this
     */
    public function setIsAdditional(?bool $isAdditional): ReferralLink
    {
        $this->isAdditional = $isAdditional;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDirectTracking(): ?bool
    {
        return $this->directTracking;
    }

    /**
     * @param bool|null $directTracking
     * @return $this
     */
    public function setDirectTracking(?bool $directTracking): ReferralLink
    {
        $this->directTracking = $directTracking;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDirectTrackingRedirect(): ?bool
    {
        return $this->directTrackingRedirect;
    }

    /**
     * @param bool|null $directTrackingRedirect
     * @return $this
     */
    public function setDirectTrackingRedirect(?bool $directTrackingRedirect): ReferralLink
    {
        $this->directTrackingRedirect = $directTrackingRedirect;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDirectTrackingRedirectUrl(): ?string
    {
        return $this->directTrackingRedirectUrl;
    }

    /**
     * @param string|null $directTrackingRedirectUrl
     * @return $this
     */
    public function setDirectTrackingRedirectUrl(?string $directTrackingRedirectUrl): ReferralLink
    {
        $this->directTrackingRedirectUrl = $directTrackingRedirectUrl;
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
            'url' => $this->getUrl(),
            'default' => $this->getDefault(),
            'isAdditional' => $this->getIsAdditional(),
            'directTracking' => $this->getDirectTracking(),
            'directTrackingRedirect' => $this->getDirectTrackingRedirect(),
            'directTrackingRedirectUrl' => $this->getDirectTrackingRedirectUrl()
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
