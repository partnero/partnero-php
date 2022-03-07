<?php

namespace Partnero\Exceptions;

use JsonException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PartneroHttpRequestValidationException extends PartneroException
{
    /**
     * @var array|mixed
     */
    protected array $errors = [];

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
    public function __construct(RequestInterface $request, ResponseInterface $response) {
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

        parent::__construct($data['message'] ?? '');

        $this->request = $request;
        $this->response = $response;
        $this->errors = $data['errors'] ?? [];
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
     * @return array|mixed
     */
    public function getErrors(): mixed
    {
        return $this->errors;
    }
}
