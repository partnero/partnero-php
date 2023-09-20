<?php

declare(strict_types=1);

namespace Partnero\Models;

class Webhook extends AbstractModel
{
    /**
     * @var string|null
     */
    protected ?string $key = null;

    /**
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * @var bool|null
     */
    protected ?bool $isActive = null;

    /**
     * @var array|null
     */
    protected ?array $events = null;

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
    public function setKey(?string $key): Webhook
    {
        $this->key = $key;
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
    public function setName(?string $name): Webhook
    {
        $this->name = $name;
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
    public function setUrl(?string $url): Webhook
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param bool|null $isActive
     * @return $this
     */
    public function setIsActive(?bool $isActive): Webhook
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getEvents(): ?array
    {
        return $this->events;
    }

    /**
     * @param string[]|null $events
     * @return $this
     *
     * @link https://developers.partnero.com/reference/webhooks.html#available-events
     */
    public function setEvents(?array $events): Webhook
    {
        $this->events = $events;
        return $this;
    }

    /**
     * @return string[]
     */
    public function __toArray(): array
    {
        return [
            'key' => $this->getKey(),
            'name' => $this->getName(),
            'url' => $this->getUrl(),
            'events' => $this->getEvents(),
            'is_active' => $this->getIsActive(),
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
