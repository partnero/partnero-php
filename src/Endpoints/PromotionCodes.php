<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Models\Coupon;
use Partnero\Models\PromotionCode;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;

class PromotionCodes extends AbstractEndpoint
{
    /**
     * @return string
     */
    protected function getEndpointUri(): string
    {
        return 'promotion-codes';
    }

    /**
     * @param  int|null $limit
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
     * @param  string|PromotionCode $code
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function find(string|PromotionCode $code): array
    {
        return $this->call(
            'get',
            [],
            $this->getEndpointUri() . '/' . $code
        );
    }

    /**
     * @param  int|Coupon $couponId
     * @param  array|PromotionCode $promotionCode
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function create(int|Coupon $couponId, array $promotionCode): array
    {
        if($couponId instanceof Coupon) {
            $couponId = (int)$couponId->getId();
        }

        return $this->call(
            'post',
            array_merge(
                ['coupon_id' => $couponId],
                $this->modelData($promotionCode)
            )
        );
    }

    /**
     * @param  array|PromotionCode $promotionCode
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function update(array|PromotionCode $promotionCode): array
    {
        return $this->call('put', $this->modelData($promotionCode));
    }

    /**
     * @param  string|PromotionCode $promotionCode
     * @param  array|Coupon $coupon
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws RequestException
     */
    public function delete(string|PromotionCode $promotionCode, array|Coupon $coupon): array
    {
        $data['code'] = (string)$promotionCode;
        $data['coupon'] = $this->modelData($coupon);

        return $this->call('delete', $data);
    }
}
