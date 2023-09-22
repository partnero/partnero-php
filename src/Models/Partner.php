<?php

declare(strict_types=1);

namespace Partnero\Models;

class Partner extends AbstractModel
{
    /**
     * @var int|null
     */
    protected ?int $id = null;

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
    protected ?string $name = null;

    /**
     * @var string|null
     */
    protected ?string $surname = null;

    /**
     * @var string|null
     */
    protected ?string $email = null;

    /**
     * @var string|null
     */
    protected ?string $password = null;

    /**
     * @return int|null
     */
    public function getId(): int|null
    {
        return $this->id;
    }

    /**
     * @param  int|null $id
     * @return $this
     */
    public function setId(int|null $id): Partner
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
    public function setKey(?string $key): Partner
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
    public function setName(?string $name): Partner
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     * @return $this
     */
    public function setSurname(?string $surname): Partner
    {
        $this->surname = $surname;
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
    public function setEmail(?string $email): Partner
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return $this
     */
    public function setPassword(?string $password): Partner
    {
        $this->password = $password;
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
            'email' => $this->getEmail(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'password' => $this->getPassword(),
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
