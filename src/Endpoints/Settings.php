<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;

class Settings extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'settings';
    }

    /**
     * @param array $settings
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(array $settings):array
    {
        return $this->call('put', [
            'settings' => $settings
        ]);
    }
}
