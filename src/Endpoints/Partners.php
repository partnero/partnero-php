<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Models\Partner;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;

class Partners extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'partners';
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
     * @param string|Partner|null $key
     * @param string|null $email
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function find(string|Partner $key = null, string $email = null): array
    {
        return $this->call(
            'get',
            self::keyOrEmailSearchParams($key, $email),
            $this->getEndpointUri() . '/' . $key
        );
    }

    /**
     * @param array|Partner $partner
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(array|Partner $partner): array
    {
        return $this->call('post', $this->modelData($partner));
    }

    /**
     * @param string|Partner $key
     * @param array|Partner $partner
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(string|Partner $key, array|Partner $partner): array
    {
        return $this->call(
            'put',
            array_merge(
                ['update' => $this->modelData($partner)],
                self::keyOrEmailSearchParams($key)
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
     * @param string|Partner|null $key
     * @param string|null $email
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string|null|Partner $key = null, string $email = null): array
    {
        return $this->call('delete', self::keyOrEmailSearchParams($key, $email));
    }

    /**
     * @param string|Partner|null $key
     * @param string|null $email
     * @return array
     */
    public static function keyOrEmailSearchParams(string|null|Partner $key = null, ?string $email = null): array
    {
        $params = [];

        if (!empty($key) && is_string($key)) {
            $params['key'] = $key;
        } elseif ($key instanceof Partner) {
            if (!is_null($key->getKey())) {
                $params['key'] = $key->getKey();
            } elseif (!is_null($key->getEmail())) {
                $params['email'] = $key->getEmail();
            }
        } elseif (!empty($email)) {
            $params['email'] = $email;
        }

        return $params;
    }
}
