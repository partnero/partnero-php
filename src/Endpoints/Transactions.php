<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;
use Partnero\Models\Customer;
use Partnero\Models\Transaction;

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
     * @param Transaction $transaction
     * @param Customer $customer
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(Transaction $transaction, Customer $customer): array
    {
        $params = $this->modelData($transaction);
        $params['customer'] = $this->modelData($customer);

        return $this->call('post', $this->modelData($params));
    }

    /**
     * @param Transaction $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(Transaction $key): array
    {
        return $this->call('delete', ['key' => (string)$key,], $this->getEndpointUri() . '/' . $key);
    }
}
