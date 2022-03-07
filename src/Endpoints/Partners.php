<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;

class Partners extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'partners';
    }

    /**
     * @param int|null $limit
     * @return array
     * @throws JsonException
     * @throws RequestException
     * @throws ClientExceptionInterface
     */
    public function get(int $limit = null): array
    {
        $params = [];

        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        return $this->call('get', $params);
    }
}
