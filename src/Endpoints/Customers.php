<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Partnero\Models\BalanceCredit;
use Partnero\Models\Customer;
use Partnero\Models\Partner;
use Partnero\Models\Transaction as TransactionModel;
use Psr\Http\Client\ClientExceptionInterface;

class Customers extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'customers';
    }

    /**
     * @param int|null $limit
     * @param string|Partner|null $partner
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function list(int $limit = null, string|null|Partner $partner = null): array
    {
        $params = [];

        if (!is_null($partner)) {
            $params['partner'] = Partners::keyOrEmailSearchParams($partner);
        }

        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        return $this->call('get', $params);
    }

    /**
     * @param array|Customer $customer
     * @param array|Partner|Customer|null $partnerOrCustomer
     * @param array|TransactionModel|null $transaction
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(
        array|Customer $customer,
        array|Partner|Customer $partnerOrCustomer = null,
        array|TransactionModel $transaction = null
    ): array {
        $data = $this->modelData($customer);

        if ($partnerOrCustomer instanceof Partner) {
            $data['partner'] = $this->modelData($partnerOrCustomer);
        }

        if ($partnerOrCustomer instanceof Customer) {
            $data['referring_customer'] = $this->modelData($partnerOrCustomer);
        }

        if (!empty($transaction)) {
            $data['transaction'] = $this->modelData($transaction);
        }

        return $this->call('post', $data);
    }

    /**
     * @param string|Customer $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function find(string|Customer $key): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri() . '/' . $key
        );
    }

    /**
     * @param string|Customer $key
     * @param array|Customer $customer
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(string|Customer $key, array|Customer $customer): array
    {
        return $this->call('put', [
            'key' => (string)$key,
            'update' => $this->modelData($customer)
        ]);
    }

    /**
     * @param string|Customer $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string|Customer $key): array
    {
        return $this->call(
            'delete',
            [],
            $this->getEndpointUri() . '/' . $key
        );
    }

    /**
     * @param string|Customer $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function balance(string|Customer $key): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri() . '/' . $key . '/balance'
        );
    }

    /**
     * @param string|Customer $key
     * @param array|BalanceCredit $credit
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function credit(string|Customer $key, array|BalanceCredit $credit): array
    {
        return $this->call(
            'post',
            $this->modelData($credit),
            $this->getEndpointUri() . '/' . $key . '/balance/credit'
        );
    }
}
