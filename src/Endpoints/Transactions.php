<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Partnero\Models\Partner as PartnerModel;
use Psr\Http\Client\ClientExceptionInterface;
use Partnero\Models\Customer as CustomerModel;
use Partnero\Models\Transaction as TransactionModel;

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
     * @param array|TransactionModel $transaction
     * @param array|CustomerModel $customer
     * @param array|PartnerModel|null $partner
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(
        array|TransactionModel $transaction,
        array|CustomerModel $customer,
        array|PartnerModel $partner = null
    ): array {
        $transaction = $this->modelData($transaction);
        $transaction['customer'] = $this->modelData($customer);

        if (!empty($partner)) {
            $transaction['partner'] = $this->modelData($partner);
        }

        return $this->call('post', $this->modelData($transaction));
    }

    /**
     * @param string|TransactionModel|null $key
     * @param int|null $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string|TransactionModel $key = null, int $id = null): array
    {
        $params = [];

        if (!is_null($key)) {
            $keyValue = (string)$key;
            if (!empty($keyValue)) {
                $params['key'] = $keyValue;
            }
        }

        if (!is_null($id)) {
            $params['id'] = $id;
        } elseif ($key instanceof TransactionModel && !is_null($key->getId())) {
            $params['id'] = $key->getId();
        }
        
        return $this->call('delete', $params);
    }
}
