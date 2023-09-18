<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Models\Customer;
use Partnero\Models\BalanceCredit;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;

class ReferralCustomers extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'customers';
    }

    /**
     * @param  string|Customer $id
     * @return string
     */
    protected function getId(string|Customer $id): string
    {
        if($id instanceof Customer) {
            return (string)$id->getId();
        }
        return $id;
    }

    /**
     * @param int|null $limit
     * @param int|null $page
     * @param string|null $refer_status (referred, non_referred)
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function list(
        int|null $limit = null,
        int|null $page = null,
        string|null $refer_status = null
    ): array
    {
        $params = [];

        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        if (!is_null($page)) {
            $params['page'] = $page;
        }

        if (!is_null($refer_status)) {
            $params['refer_status'] = $refer_status;
        }

        return $this->call('get', $params);
    }

    /**
     * @param array|Customer $customer
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function createReferring(array|Customer $customer): array
    {
        return $this->call('post', $this->modelData($customer));
    }

    /**
     * @param array|Customer $customer
     * @param array|Customer $referringCustomer
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function createReferred(array|Customer $customer, array|Customer $referringCustomer): array
    {
        $data = $this->modelData($customer);
        $data['referring_customer'] = $this->modelData($referringCustomer);

        return $this->call('post', $data);
    }

    /**
     * @param string|Customer $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function find(string|Customer $id): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri(). '/' .$this->getId($id)
        );
    }

    /**
     * @param string|Customer $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function referrals(string|Customer $id): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri(). '/' .$this->getId($id). '/referrals'
        );
    }

    /**
     * @param string|Customer $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function stats(string|Customer $id): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri(). '/' .$this->getId($id). '/stats'
        );
    }

    /**
     * @param array|Customer $customer
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function search(array|Customer $customer): array
    {
        return $this->call(
            'get',
            $this->modelData($customer),
            $this->getEndpointUri(). ':search'
        );
    }

    /**
     * @param string|Customer $id
     * @param array|Customer $customer
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(string|Customer $id, array|Customer $customer): array
    {
        return $this->call('put', [
            'id' => $id,
            'update' => $this->modelData($customer)
        ]);
    }

    /**
     * @param string|Customer $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string|Customer $id): array
    {
        return $this->call('delete', [], $this->getEndpointUri(). '/' .$this->getId($id));
    }

    /**
     * @param array|Customer $customer
     * @param array|null $personalization
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function invite(array|Customer $customer, array|null $personalization = null): array
    {
        $data = $this->modelData($customer);
        if(!empty($personalization)) {
            $data['personalization'] = $personalization;
        }

        return $this->call('post', $data, $this->getEndpointUri() . ':invite');
    }

    /**
     * @param string|Customer $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function balance(string|Customer $id): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri() . '/' . $this->getId($id) . '/balance'
        );
    }

    /**
     * @param string|Customer $id
     * @param array|BalanceCredit $credit
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function credit(string|Customer $id, array|BalanceCredit $credit): array
    {
        return $this->call(
            'post',
            $this->modelData($credit),
            $this->getEndpointUri() . '/' . $this->getId($id) . '/balance/credit'
        );
    }
}
