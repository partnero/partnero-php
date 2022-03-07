<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;

class Transactions extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'transactions';
    }

    /**
     * @param array $data
     * @return array
     * @throws JsonException
     * @throws RequestException
     * @throws ClientExceptionInterface
     */
    public function create(array $data): array
    {
        return $this->call('post', $data);
    }

    /**
     * @param string|null $key
     * @param int|null $id
     * @return array
     * @throws JsonException
     * @throws RequestException
     * @throws ClientExceptionInterface
     */
    public function delete(string $key = null, int $id = null): array
    {
        $params = [];

        if (!is_null($key)) {
            $params['key'] = $key;
        }

        if (!is_null($id)) {
            $params['id'] = $id;
        }

        return $this->call('delete', $params);
    }
}
