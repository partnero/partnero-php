<?php

namespace Partnero\Exceptions;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Client\RequestExceptionInterface;

class PartneroHttpException extends PartneroException implements RequestExceptionInterface
{
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
     */
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $message = sprintf(
            '[url] %s [http method] %s [status code] %s [reason phrase] %s',
            $request->getRequestTarget(),
            $request->getMethod(),
            $response->getStatusCode(),
            $response->getReasonPhrase()
        );

        parent::__construct($message, $response->getStatusCode());
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
}
