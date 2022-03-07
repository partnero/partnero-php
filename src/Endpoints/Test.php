<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;

class Test extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'test';
    }

    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function test(): array
    {
        return $this->call('get');
    }
}
