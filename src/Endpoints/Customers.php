<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Partnero\Models\BalanceCredit;
use Partnero\Models\Customer;
use Partnero\Models\Partner;
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
     * @param Partner|null $partner
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function list(int $limit = null, ?Partner $partner = null): array
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
     * @param Customer $customer
     * @param int|null $limit
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function referrals(Customer $customer, int $limit = null): array
    {
        $params = [];
        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        return $this->call('get', $params, $this->getEndpointUri() . '/' . $customer . '/referrals');
    }

    /**
     * @param Customer $customer
     * @param Partner|Customer|null $partnerOrCustomer
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(Customer $customer, null|Partner|Customer $partnerOrCustomer = null): array
    {
        $params = $this->modelData($customer);

        if ($partnerOrCustomer instanceof Partner) {
            $params['partner'] = $this->modelData($partnerOrCustomer);
        }

        if ($partnerOrCustomer instanceof Customer) {
            $params['referring_customer'] = $this->modelData($partnerOrCustomer);
        }

        return $this->call('post', $params);
    }

    /**
     * @param Customer $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function find(Customer $key): array
    {
        return $this->call('get', [], $this->getEndpointUri() . '/' . $key);
    }

    /**
     * @param Customer $key
     * @param Customer $customer
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(Customer $key, Customer $customer): array
    {
        return $this->call('put', [
            'key' => (string)$key,
            'update' => $this->modelData($customer)
        ]);
    }

    /**
     * @param Customer $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(Customer $key): array
    {
        return $this->call('delete', [], $this->getEndpointUri() . '/' . $key);
    }

    /**
     * @param Customer $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function balance(Customer $key): array
    {
        return $this->call('get', [], $this->getEndpointUri() . '/' . $key . '/balance');
    }

    /**
     * @param Customer $key
     * @param BalanceCredit $credit
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function credit(Customer $key, BalanceCredit $credit): array
    {
        return $this->call('post', $this->modelData($credit), $this->getEndpointUri() . '/' . $key . '/balance/credit');
    }
}
