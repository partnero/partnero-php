<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Partnero\Models\Partner;
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
     * @param array|Transaction $transaction
     * @param array|Customer $customer
     * @param array|Partner|null $partner
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(
        array|Transaction $transaction,
        array|Customer $customer,
        array|Partner $partner = null
    ): array {
        $transaction = $this->modelData($transaction);
        $transaction['customer'] = $this->modelData($customer);

        if (!empty($partner)) {
            $transaction['partner'] = $this->modelData($partner);
        }

        return $this->call('post', $this->modelData($transaction));
    }

    /**
     * @param string|Transaction $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string|Transaction $key): array
    {
        return $this->call(
            'delete',
            ['key' => (string)$key,],
            $this->getEndpointUri() . '/' . $key
        );
    }

    /**
     * @param string|Transaction $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function archive(string|Transaction $key): array
    {
        return $this->call(
            'post',
            ['key' => (string)$key,],
            $this->getEndpointUri() . '/' . $key . '/archive'
        );
    }

    /**
     * @param string|Transaction $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function revokeArchived(string|Transaction $key): array
    {
        return $this->call(
            'post',
            ['key' => (string)$key,],
            $this->getEndpointUri() . '/' . $key . '/revoke-archive'
        );
    }
}
