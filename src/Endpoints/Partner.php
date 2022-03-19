<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Exceptions\RequestException;
use Partnero\Models\Partner as PartnerModel;
use Psr\Http\Client\ClientExceptionInterface;

class Partner extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'partner';
    }

    /**
     * @param array|PartnerModel $partner
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(array|PartnerModel $partner): array
    {
        return $this->call('post', $this->modelData($partner));
    }

    /**
     * @param string|PartnerModel|null $key
     * @param string|null $email
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function get(string|PartnerModel $key = null, string $email = null): array
    {
        return $this->call('get', $this->keyOrEmailSearchParams($key, $email));
    }

    /**
     * @param string|PartnerModel $key
     * @param array|PartnerModel $partner
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(string|PartnerModel $key, array|PartnerModel $partner): array
    {
        return $this->call('put', [
            'key' => (string)$key,
            'update' => $this->modelData($partner)
        ]);
    }

    /**
     * @param string|PartnerModel|null $key
     * @param string|null $email
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string|PartnerModel $key = null, string $email = null): array
    {
        return $this->call('delete', $this->keyOrEmailSearchParams($key, $email));
    }

    /**
     * @param string|PartnerModel|null $key
     * @param string|null $email
     * @return array
     */
    protected function keyOrEmailSearchParams(string|PartnerModel $key = null, string $email = null): array
    {
        $params = [];

        if (!is_null($key)) {
            $keyValue = (string)$key;
            if (!empty($keyValue)) {
                $params['key'] = $keyValue;
            }
        }

        if (!is_null($email)) {
            $params['email'] = $email;
        } elseif ($key instanceof PartnerModel && !is_null($key->getEmail())) {
            $params['email'] = $key->getEmail();
        }

        return $params;
    }
}
