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
     * @param Partner $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function find(Partner $key): array
    {
        return $this->call('get', self::keyOrEmailSearchParams($key), $this->getEndpointUri() . '/' . $key);
    }

    /**
     * @param Partner $partner
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(Partner $partner): array
    {
        return $this->call('post', $this->modelData($partner));
    }

    /**
     * @param Partner $key
     * @param Partner $partner
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(Partner $key, Partner $partner): array
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
     * @param Partner $key
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(Partner $key): array
    {
        return $this->call('delete', self::keyOrEmailSearchParams($key));
    }

    /**
     * @param string|Partner|null $key
     * @return array
     */
    public static function keyOrEmailSearchParams(string|null|Partner $key = null): array
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
        }

        return $params;
    }
}
