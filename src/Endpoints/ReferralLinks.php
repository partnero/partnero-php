<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Partnero\Models\ReferralLink;
use Psr\Http\Client\ClientExceptionInterface;

class ReferralLinks extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'partner';
    }

    /**
     * @param string $key
     * @param int|null $limit
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function list(string $key, int $limit = null): array
    {
        $params = [];

        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        return $this->call(
            'get',
            $params,
            $this->getEndpointUri() . '/' . $key . '/links'
        );
    }

    /**
     * @param string $partnerId
     * @param string $linkPartnerKey
     * @param string $linkKey
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function get(string $partnerId, string $linkPartnerKey, string $linkKey): array
    {
        return $this->call(
            'get',
            ['partnerId' => $partnerId],
            $this->getEndpointUri() . '/' . $linkPartnerKey . '/links/' . $linkKey
        );
    }

    /**
     * @param string $partnerId
     * @param array|ReferralLink $link
     * @param int|null $domainId
     * @param bool|null $isAdditional
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(string $partnerId, array|ReferralLink $link, int $domainId = null, bool $isAdditional = null): array
    {
        return $this->call('post',
            array_merge(
                $this->modelData($link),
                [
                    'domain_id' => $domainId,
                    'is_additional' => $isAdditional ?? false
                ]),
            $this->getEndpointUri() . '/' . $partnerId . '/links'
        );
    }

    /**
     * @param string $partnerId
     * @param string $linkPartnerKey
     * @param string $linkKey
     * @param array|ReferralLink $link
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(string $partnerId, string $linkPartnerKey, string $linkKey, array|ReferralLink $link): array
    {
        return $this->call(
            'put',
            array_merge(
                $this->modelData($link),
                ['partnerId' => $partnerId],
            ),
            $this->getEndpointUri() . '/' . $linkPartnerKey . '/links/' . $linkKey,
        );
    }

    /**
     * @param string $partnerId
     * @param string $linkPartnerKey
     * @param string $linkKey
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string $partnerId, string $linkPartnerKey, string $linkKey): array
    {
        return $this->call(
            'delete',
            ['partnerId' => $partnerId],
            $this->getEndpointUri() . '/' . $linkPartnerKey . '/links/' . $linkKey
        );
    }
}
