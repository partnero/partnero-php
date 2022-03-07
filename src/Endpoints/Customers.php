<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
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
     * @param string $partnerKey
     * @param int|null $limit
     * @return array
     * @throws JsonException
     * @throws RequestException
     * @throws ClientExceptionInterface
     */
    public function get(string $partnerKey, int $limit = null):array
    {
        $params = ['partner_key' => $partnerKey];

        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        return $this->call('get', $params);
    }
}
