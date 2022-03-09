<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;

class Customer extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'customer';
    }

    /**
     * @param array $customer
     * @param array $partner
     * @param array|null $transaction
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(array $customer, array $partner, ?array $transaction = null): array
    {
        $params = ['customer' => $customer, 'partner' => $partner];

        if (!empty($transaction)) {
            $params['reward'] = $transaction;
        }

        return $this->call('post', $params);
    }

    /**
     * @param string $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws RequestException
     * @throws JsonException
     */
    public function get(string $key): array
    {
        return $this->call('get', [
            'key' => $key
        ]);
    }

    /**
     * @param string $key
     * @param array $data
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(string $key, array $data): array
    {
        return $this->call('put', [
            'key' => $key,
            'update' => $data
        ]);
    }

    /**
     * @param string $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string $key): array
    {
        return $this->call('delete', [
            'key' => $key,
        ]);
    }
}
