<?php

namespace Partnero\Http;

use Http\Promise\Promise;
use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Partnero\Exceptions\PartneroHttpException;
use Partnero\Exceptions\PartneroHttpRequestValidationException;

class HttpErrorHelper implements Plugin
{
    /**
     * @param RequestInterface $request
     * @param callable $next
     * @param callable $first
     * @return Promise
     * @throws PartneroHttpException
     * @throws PartneroHttpRequestValidationException
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(function (ResponseInterface $response) use ($request) {
            $code = (int)$response->getStatusCode();

            if ($code >= 200 && $code < 400) {
                return $response;
            }

            if ($code === 422) {
                throw new PartneroHttpRequestValidationException($request, $response);
            }

            throw new PartneroHttpException($request, $response);
        });
    }
}
