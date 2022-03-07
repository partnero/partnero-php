<?php

declare(strict_types=1);

namespace Partnero\Endpoints;

use JsonException;
use Partnero\Partnero;
use Partnero\Http\HttpLayer;
use Partnero\Exceptions\RequestException;
use Psr\Http\Client\ClientExceptionInterface;

abstract class AbstractEndpoint
{
    /**
     * @var array
     */
    protected array $options;

    /**
     * @var HttpLayer
     */
    protected HttpLayer $httpLayer;

    /**
     * @param HttpLayer $httpLayer
     * @param array $options
     */
    public function __construct(HttpLayer $httpLayer, array $options)
    {
        $this->options = $options;
        $this->httpLayer = $httpLayer;
    }

    /**
     * @return string
     */
    abstract protected function getEndpointUri(): string;

    /**
     * @param string $method
     * @param array $body
     * @param string|null $uri
     * @return array
     * @throws RequestException
     * @throws JsonException
     * @throws ClientExceptionInterface
     */
    public function call(string $method, array $body = [], ?string $uri = null):array
    {
        $uri = $this->uri($uri ?? $this->getEndpointUri());
        return match (strtoupper($method)) {
            'GET' => $this->httpLayer->get($uri, $body),
            'PUT' => $this->httpLayer->put($uri, $body),
            'POST' => $this->httpLayer->post($uri, $body),
            'DELETE' => $this->httpLayer->delete($uri, $body),
            default => throw new RequestException(sprintf('Invalid http method: %s', $method))
        };
    }

    /**
     * @param string $uri
     * @return string
     */
    protected function uri(string $uri): string
    {
        return rtrim($this->getBaseUrl(), '/') . (!empty($uri) ? '/' . $uri : '');
    }

    /**
     * @return string
     */
    protected function getBaseUrl(): string
    {
        $url = sprintf('%s://%s', $this->options[Partnero::OPTION_PROTOCOL], $this->options[Partnero::OPTION_HOST]);
        return empty($this->options[Partnero::OPTION_API_PATH]) ? $url : $url . '/' . $this->options[Partnero::OPTION_API_PATH];
    }
}
