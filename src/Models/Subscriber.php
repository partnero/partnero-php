<?php

declare(strict_types=1);

namespace Partnero\Models;

class Subscriber extends AbstractModel
{
    /**
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * This is esp identifier
     * For unique identifier use $id
     *
     * @var string|null
     */
    protected ?string $identifier = null;

    /**
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * @var string|null
     */
    protected ?string $email = null;

    /**
     * @var bool|null
     */
    protected ?bool $approved = null;

    /**
     * @var bool|null
     */
    protected ?bool $tos = null;

    /**
     * @var bool|null
     */
    protected ?bool $marketing_consent = null;

    /**
     * @var string|null
     */
    protected ?string $status = null;

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
    public function setId(string|null $id): Subscriber
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    /**
     * This is for public identifier
     * For unique identifier use setId
     *
     * @param string|null $identifier
     * @return $this
     */
    public function setIdentifier(?string $identifier): Subscriber
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): Subscriber
    {
        $this->name = $name;
        return $this;
    }


    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return $this
     */
    public function setEmail(?string $email): Subscriber
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getApproved(): ?bool
    {
        return $this->approved;
    }

    /**
     * @param bool|null $approved
     * @return $this
     */
    public function setApproved(?bool $approved): Subscriber
    {
        $this->approved = $approved;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getTos(): ?bool
    {
        return $this->tos;
    }

    /**
     * @param bool|null $tos
     * @return $this
     */
    public function setTos(?bool $tos): Subscriber
    {
        $this->tos = $tos;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getMarketingConsent(): ?bool
    {
        return $this->marketing_consent;
    }

    /**
     * @param bool|null $marketing_consent
     * @return $this
     */
    public function setMarketingConsent(?bool $marketing_consent): Subscriber
    {
        $this->marketing_consent = $marketing_consent;
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
    public function setStatus(?string $status): Subscriber
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
            'identifier' => $this->getIdentifier(),
            'email' => $this->getEmail(),
            'name' => $this->getName(),
            'approved' => $this->getApproved(),
            'tos' => $this->getTos(),
            'marketing_consent' => $this->getMarketingConsent(),
            'status' => $this->getStatus(),
        ];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->getIdentifier();
    }
}
