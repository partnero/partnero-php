<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Models\Partner;
use Partnero\Models\Customer;
use Partnero\Models\Transaction;
use Partnero\Models\BalanceCredit;
use Partnero\Exceptions\RequestException;
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
     * @param array|Partner $partner
     * @param array|Transaction|null $transaction
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(
        array|Customer $customer,
        array|Partner $partner,
        array|Transaction $transaction = null
    ): array {
        $data = $this->modelData($customer);
        $data['partner'] = $this->modelData($partner);

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
     * @param array|Customer $customer
     * @param array|null $personalization
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function invite(array|Customer $customer, ?array $personalization = null): array
    {
        $data = $this->modelData($customer);
        if(!empty($personalization)) {
            $data['personalization'] = $personalization;
        }

        return $this->call('post', $data, $this->getEndpointUri() . ':invite');
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
