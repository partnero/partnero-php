<?php

declare(strict_types=1);

namespace Partnero\Exceptions;

use JsonException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Client\RequestExceptionInterface;

class PartneroHttpException extends PartneroException implements RequestExceptionInterface
{
    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @var ResponseInterface
     */
    protected ResponseInterface $response;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @throws JsonException
     */
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;

        $body = $response->getBody()->getContents();
        $this->data = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

        parent::__construct($this->data['message'] ?? '');
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @return array
     */
    public function getData(): mixed
    {
        return $this->data;
    }
}
