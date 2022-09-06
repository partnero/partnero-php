<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Partnero\Models\Partner as PartnerModel;
use Psr\Http\Client\ClientExceptionInterface;
use Partnero\Models\Customer as CustomerModel;
use Partnero\Models\Transaction as TransactionModel;

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
     * @param array|CustomerModel $customer
     * @param array|PartnerModel $partner
     * @param array|TransactionModel|null $transaction
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(
        array|CustomerModel $customer,
        array|PartnerModel $partner,
        array|TransactionModel $transaction = null
    ): array {
        $data = [
            'customer' => $this->modelData($customer),
            'partner' => $this->modelData($partner)
        ];

        if (!empty($transaction)) {
            $data['transaction'] = $this->modelData($transaction);
        }

        return $this->call('post', $data);
    }

    /**
     * @param string|CustomerModel $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function get(string|CustomerModel $key): array
    {
        return $this->call('get', [
            'key' => (string)$key
        ]);
    }

    /**
     * @param string|CustomerModel $key
     * @param array|CustomerModel $customer
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(string|CustomerModel $key, array|CustomerModel $customer): array
    {
        return $this->call('put', [
            'key' => (string)$key,
            'update' => $this->modelData($customer)
        ]);
    }

    /**
     * @param string|CustomerModel $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string|CustomerModel $key): array
    {
        return $this->call('delete', [
            'key' => (string)$key,
        ]);
    }
}
