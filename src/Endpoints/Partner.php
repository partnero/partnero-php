<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;

class Partner extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'partner';
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
     * @param string|null $email
     * @return array
     * @throws JsonException
     * @throws RequestException
     * @throws ClientExceptionInterface
     */
    public function get(string $key = null, string $email = null): array
    {
        $params = [];

        if (!is_null($key)) {
            $params['key'] = $key;
        }

        if (!is_null($email)) {
            $params['email'] = $email;
        }

        return $this->call('get', $params);
    }

    /**
     * @param string $key
     * @param array $data
     * @return array
     * @throws ClientExceptionInterface
     * @throws RequestException
     * @throws JsonException
     */
    public function update(string $key, array $data): array
    {
        return $this->call('put', [
            'key' => $key,
            'update' => $data
        ]);
    }

    /**
     * @param string|null $key
     * @param string|null $email
     * @return array
     * @throws ClientExceptionInterface
     * @throws RequestException
     * @throws JsonException
     */
    public function delete(string $key = null, string $email = null): array
    {
        $params = [];

        if (!is_null($key)) {
            $params['key'] = $key;
        }

        if (!is_null($email)) {
            $params['email'] = $email;
        }

        return $this->call('delete', $params);
    }
}
