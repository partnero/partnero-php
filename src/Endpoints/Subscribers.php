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
    public function list(int $limit = null): array
    {
        $params = [];

        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        return $this->call('get', $params);
    }

    /**
     * @param string|Subscriber|null $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function find(string|Subscriber $key = null): array
    {
        return $this->call(
            'get',
            self::keySearchParams($key),
            $this->getEndpointUri() . '/' . $key
        );
    }

    /**
     * @param array|Subscriber $subscriber
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(array|Subscriber $subscriber): array
    {
        return $this->call('post', $this->modelData($subscriber));
    }

    /**
     * @param string|Subscriber $key
     * @param array|Subscriber $subscriber
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(string|Subscriber $key, array|Subscriber $subscriber): array
    {
        return $this->call(
            'put',
            array_merge(
                ['update' => $this->modelData($subscriber)],
                self::keySearchParams($key)
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
     * @param string|Subscriber|null $key
     * @param string|null $email
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string|null|Subscriber $key = null, string $email = null): array
    {
        return $this->call('delete', self::keySearchParams($key, $email));
    }

    /**
     * @param string|Subscriber|null $key
     * @return array
     */
    public static function keySearchParams(string|null|Subscriber $key = null): array
    {
        $params = [];

        if (!empty($key) && is_string($key)) {
            $params['key'] = $key;
        } elseif ($key instanceof Subscriber) {
            if (!is_null($key->getKey())) {
                $params['key'] = $key->getKey();
            }
        }

        return $params;
    }
}
