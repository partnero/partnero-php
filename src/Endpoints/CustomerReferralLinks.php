<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Partnero\Models\ReferralLink;
use Partnero\Models\Partner;
use Psr\Http\Client\ClientExceptionInterface;

class CustomerReferralLinks extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'customer_referral_links';
    }

    /**
     * @param string $partnerKey
     * @param int|null $limit
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function list(string $partnerKey, int $limit = null): array
    {
        $params = [];

        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        return $this->call(
            'get',
            $params,
            'customers/' . $partnerKey . '/referral_links'
        );
    }

    /**
     * @param string $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function get(string $id): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri() . '/' . $id
        );
    }

    /**
     * @param array|ReferralLink $link
     * @param array|Partner $partner
     * @param int|null $domainId
     * @param bool|null $isAdditional
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(
        array|ReferralLink $link,
        array|Partner $partner,
        int $domainId = null,
        bool $isAdditional = null
    ): array
    {
        $data = array_merge(
                    $this->modelData($link),
                    [
                        'domain_id' => $domainId,
                        'is_additional' => $isAdditional ?? false
                ]);

        $data['customer'] = $this->modelData($partner);

        return $this->call('post', $data);
    }

    /**
     * @param string $id
     * @param array|ReferralLink $link
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(string $id, array|ReferralLink $link): array
    {
        $data = $this->modelData($link);

        return $this->call('put', $data, $this->getEndpointUri() . '/' . $id);
    }

    /**
     * @param array $params
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function search(array $params = []): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri() . ':search' . (!empty($params) ? '?' . http_build_query($params) : '')
        );
    }

    /**
     * @param string $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string $id): array
    {
        return $this->call(
            'delete',
            [],
            $this->getEndpointUri() . '/' . $id
        );
    }
}
