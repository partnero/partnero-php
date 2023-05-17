<?php

declare(strict_types=1);

namespace Partnero\Http;

use JsonException;
use Partnero\Partnero;
use Psr\Http\Client\ClientInterface;
use Http\Client\Common\PluginClient;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use Http\Message\Authentication\Bearer;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Http\Client\Common\Plugin\ContentTypePlugin;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;

class HttpLayer
{
    /**
     * @var PluginClient
     */
    protected PluginClient $pluginClient;

    /**
     * @var RequestFactoryInterface|null
     */
    protected ?RequestFactoryInterface $requestFactory;

    /**
     * @var StreamFactoryInterface|null
     */
    protected ?StreamFactoryInterface $streamFactory;

    /**
     * @var array
     */
    protected array $options;

    /**
     * @param array $options
     * @param ClientInterface|null $httpClient
     * @param RequestFactoryInterface|null $requestFactory
     * @param StreamFactoryInterface|null $streamFactory
     */
    public function __construct(
        array $options = [],
        ?ClientInterface $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null
    ) {
        $this->options = $options;

        $httpClient = $httpClient ?: Psr18ClientDiscovery::find();
        $this->pluginClient = new PluginClient($httpClient, $this->buildPlugins());

        $this->streamFactory = $streamFactory ?: Psr17FactoryDiscovery::findStreamFactory();
        $this->requestFactory = $requestFactory ?: Psr17FactoryDiscovery::findRequestFactory();
    }

    /**
     * @param string $uri
     * @param array $body
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function get(string $uri, array $body = []): array
    {
        return $this->call_method('GET', $uri, $body);
    }

    /**
     * @param string $uri
     * @param array $body
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function post(string $uri, array $body = []): array
    {
        return $this->call_method('POST', $uri, $body);
    }

    /**
     * @param string $uri
     * @param array $body
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function put(string $uri, array $body = []): array
    {
        return $this->call_method('PUT', $uri, $body);
    }

    /**
     * @param string $uri
     * @param array $body
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function delete(string $uri, array $body = []): array
    {
        return $this->call_method('DELETE', $uri, $body);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $body
     * @return array
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    protected function call_method(string $method, string $uri, array $body): array
    {
        return $this->buildResponse(
            $this->pluginClient->sendRequest(
                $this->requestFactory->createRequest($method, $uri)->withBody($this->buildBody($body))
            )
        );
    }

    /**
     * @param $body
     * @return StreamInterface
     * @throws JsonException
     */
    protected function buildBody($body): StreamInterface
    {
        $stringBody = is_array($body) ? json_encode($body, JSON_THROW_ON_ERROR) : $body;
        return $this->streamFactory->createStream($stringBody);
    }

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws JsonException
     */
    protected function buildResponse(ResponseInterface $response): array
    {
        $contentTypes = $response->getHeader('Content-Type');
        $contentType = $response->hasHeader('Content-Type') ? reset($contentTypes) : null;

        $body = '';

        if ($response->getBody()) {
            $body = match ($contentType) {
                'application/json' => json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR),
                default => $response->getBody()->getContents(),
            };
        }

        return [
            'status_code' => $response->getStatusCode(),
            'headers' => $response->getHeaders(),
            'body' => $body,
            'response' => $response,
        ];
    }

    /**
     * @return array
     */
    protected function buildPlugins(): array
    {
        $authentication = new Bearer($this->options['security']['bearer']);
        $authenticationPlugin = new AuthenticationPlugin($authentication);

        $contentTypePlugin = new ContentTypePlugin();

        $headerDefaultsPlugin = new HeaderDefaultsPlugin(
            [
                'Accept' => 'application/json',
                'User-Agent' => 'partnero-php/' . Partnero::API_VERSION,
                'Sdk-Version' => Partnero::SDK_VERSION
            ]
        );

        $httpErrorPlugin = new HttpErrorHelper();

        return [
            $authenticationPlugin,
            $contentTypePlugin,
            $headerDefaultsPlugin,
            $httpErrorPlugin
        ];
    }
}
