<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Models\Coupon;
use Partnero\Models\PromotionCode;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;

class Coupons extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'coupons';
    }

    /**
     * @param  int|null $limit
     * @return array
     * @throws JsonException
     * @throws RequestException
     * @throws ClientExceptionInterface
     */
    public function list(int|null $limit = null): array
    {
        $params = [];

        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }

        return $this->call('get', $params);
    }

    /**
     * @param  string|Coupon $uuidCode
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function find(string|Coupon $uuidCode): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri() . '/' . $uuidCode
        );
    }

    /**
     * @param  array|Coupon $coupon
     * @param  array|PromotionCode[] $promotionCodes
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(array|Coupon $coupon, array $promotionCodes = []): array
    {
        $data = $this->modelData($coupon);
        $data['promotion_codes'] = [];

        foreach($promotionCodes as $promotionCode) {
            $data['promotion_codes'][] = $this->modelData($promotionCode);
        }

        return $this->call('post', $data);
    }

    /**
     * @param  array|Coupon $coupon
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(array|Coupon $coupon): array
    {
        return $this->call('put', $this->modelData($coupon));
    }

    /**
     * @param  string|Coupon $uuidCode
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string|Coupon $uuidCode): array
    {
        return $this->call(
            'delete',
            [],
            $this->getEndpointUri() . '/' . $uuidCode
        );
    }
}
