<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Models\Partner;
use Partnero\Models\BalanceCredit;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;

class Referrals extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'customers';
    }

    /**
     * @param  string|Partner $id
     * @return string
     */
    protected function getId(string|Partner $id): string
    {
        if($id instanceof Partner) {
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
     * @param array|Partner $referring
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function createReferring(array|Partner $referring): array
    {
        return $this->call('post', $this->modelData($referring));
    }

    /**
     * @param array|Partner $referred
     * @param array|Partner $referringCustomer
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function createReferred(array|Partner $referred, array|Partner $referringCustomer): array
    {
        $data = $this->modelData($referred);
        $data['referring_customer'] = $this->modelData($referringCustomer);

        return $this->call('post', $data);
    }

    /**
     * @param string|Partner $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function find(string|Partner $id): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri(). '/' .$this->getId($id)
        );
    }

    /**
     * @param string|Partner $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function listReferred(string|Partner $id): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri(). '/' .$this->getId($id). '/referrals'
        );
    }

    /**
     * @param string|Partner $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function stats(string|Partner $id): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri(). '/' .$this->getId($id). '/stats'
        );
    }

    /**
     * @param array $searchArray
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function search(array $searchArray): array
    {
        return $this->call(
            'get',
            $searchArray,
            $this->getEndpointUri(). ':search'
        );
    }

    /**
     * @param string|Partner $id
     * @param array|Partner $customer
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(string|Partner $id, array|Partner $customer): array
    {
        return $this->call('put', [
            'id'     => $this->getId($id),
            'update' => $this->modelData($customer)
        ]);
    }

    /**
     * @param string|Partner $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string|Partner $id): array
    {
        return $this->call('delete', [], $this->getEndpointUri(). '/' .$this->getId($id));
    }

    /**
     * @param array|Partner $customer
     * @param array|null $personalization
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function invite(array|Partner $customer, array|null $personalization = null): array
    {
        $data = $this->modelData($customer);
        if(!empty($personalization)) {
            $data['personalization'] = $personalization;
        }

        return $this->call('post', $data, $this->getEndpointUri() . ':invite');
    }

    /**
     * @param string|Partner $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function balance(string|Partner $id): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri() . '/' . $this->getId($id) . '/balance'
        );
    }

    /**
     * @param string|Partner $id
     * @param array|BalanceCredit $credit
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function credit(string|Partner $id, array|BalanceCredit $credit): array
    {
        return $this->call(
            'post',
            $this->modelData($credit),
            $this->getEndpointUri() . '/' . $this->getId($id) . '/balance/credit'
        );
    }
}
