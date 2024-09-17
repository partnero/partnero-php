<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Partnero\Models\Subscriber;
use Psr\Http\Client\ClientExceptionInterface;

class Subscribers extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'subscribers';
    }

    /**
     * @param int|null $limit
     * @return array
     * @throws JsonException
     * @throws RequestException
     * @throws ClientExceptionInterface
     */
    public function list(int $limit = null, string $referStatus = null): array
    {
        $params = [];

        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        if (!is_null($referStatus)) {
            $params['refer_status'] = $referStatus;
        }

        return $this->call('get', $params);
    }

    /**
     * @param string|Subscriber|null $identifier
     * @param string|null $email
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function find(string|Subscriber $identifier = null, string $email = null): array
    {
        return $this->call(
            'get',
            self::identifierOrEmailSearchParams($identifier, $email),
            $this->getEndpointUri() . '/' . $identifier
        );
    }

    /**
     * @param array|Subscriber $referredSubscriber
     * @param array|Subscriber|null $referralSubscriber
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(array|Subscriber $referredSubscriber, array|Subscriber|null $referralSubscriber = null): array
    {
        $data = $this->modelData($referredSubscriber);

        if (!empty($referralSubscriber)) {
            $data['referral'] = $this->modelData($referralSubscriber);
        }


        return $this->call('post', $data);
    }

    /**
     * @param string|Subscriber $identifier
     * @param array|Subscriber $subscriber
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(string|Subscriber $identifier, array|Subscriber $subscriber): array
    {
        return $this->call(
            'put',
            array_merge(
                ['update' => $this->modelData($subscriber)],
                self::identifierOrEmailSearchParams($identifier)
            )
        );
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
     * @param string|Subscriber|null $identifier
     * @param string|null $email
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string|null|Subscriber $identifier = null, string $email = null): array
    {
        return $this->call('delete', self::identifierOrEmailSearchParams($identifier, $email));
    }

    /**
     * @param string|Subscriber|null $identifier
     * @param string|null $email
     * @return array
     */
    public static function identifierOrEmailSearchParams(string|null|Subscriber $identifier = null, string $email = null): array
    {
        $params = [];

        if (!empty($identifier) && is_string($identifier)) {
            $params['id'] = $identifier;
        } elseif ($identifier instanceof Subscriber) {
            if (!is_null($identifier->getIdentifier())) {
                $params['id'] = $identifier->getIdentifier();
            }
        } elseif (!empty($email)) {
            $params['email'] = $email;
        }

        return $params;
    }
}
