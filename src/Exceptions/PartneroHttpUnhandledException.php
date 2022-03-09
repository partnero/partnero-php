<?php

declare(strict_types=1);

namespace Partnero\Exceptions;

use Throwable;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Client\RequestExceptionInterface;

class PartneroHttpUnhandledException extends PartneroException implements RequestExceptionInterface
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
     * @param Throwable|null $previous
     */
    public function __construct(RequestInterface $request, ResponseInterface $response, ?Throwable $previous = null)
    {
        $this->request = $request;
        $this->response = $response;

        $message = sprintf(
            '[url] %s [http method] %s [status code] %s [reason phrase] %s',
            $request->getRequestTarget(),
            $request->getMethod(),
            $response->getStatusCode(),
            $response->getReasonPhrase()
        );

        parent::__construct($message, $response->getStatusCode(), $previous);
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
