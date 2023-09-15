<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Models\Webhook;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;

class Webhooks extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'webhooks';
    }

    /**
     * @param  int|null $limit
     * @return array
     * @throws JsonException
     * @throws RequestException
     * @throws ClientExceptionInterface
     */
    public function list(int|null $limit = null): array
    {
        $params = [];

        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        return $this->call('get', $params);
    }

    /**
     * @param  string|Webhook $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function find(string|Webhook $key): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri() . '/' . $key
        );
    }

    /**
     * @param  array|Webhook $webhook
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(array|Webhook $webhook): array
    {
        return $this->call('post', $this->modelData($webhook));
    }

    /**
     * @param  string|Webhook $key
     * @param  array|Webhook $webhook
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(string|Webhook $key, array|Webhook $webhook): array
    {
        return $this->call(
            'put',
            $this->modelData($webhook),
            $this->getEndpointUri() . '/' . $key
        );
    }

    /**
     * @param  string|Webhook $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string|Webhook $key): array
    {
        return $this->call(
            'delete',
            [],
            $this->getEndpointUri() . '/' . $key
        );
    }
}
