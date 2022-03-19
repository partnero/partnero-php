<?php

declare(strict_types=1);

namespace Partnero\Models;

abstract class AbstractModel
{
    /**
     * @return array
     */
    abstract public function __toArray(): array;

    /**
     * @return string
     */
    abstract public function __toString(): string;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->cleanArray($this->__toArray());
    }

    /**
     * @param array $array
     * @return array
     */
    protected function cleanArray(array $array): array
    {
        foreach ($array as $key => $value) {
            if (is_null($value)) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}
