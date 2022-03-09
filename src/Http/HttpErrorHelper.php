<?php

declare(strict_types=1);

namespace Partnero\Http;

use Http\Promise\Promise;
use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Partnero\Exceptions\PartneroHttpNotFoundException;
use Partnero\Exceptions\PartneroHttpUnhandledException;
use Partnero\Exceptions\PartneroHttpRequestValidationException;

class HttpErrorHelper implements Plugin
{
    /**
     * @param RequestInterface $request
     * @param callable $next
     * @param callable $first
     * @return Promise
     * @throws PartneroHttpNotFoundException
     * @throws PartneroHttpRequestValidationException
     * @throws PartneroHttpUnhandledException
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(function (ResponseInterface $response) use ($request) {
            $code = $response->getStatusCode();

            if ($code >= 200 && $code < 400) {
                return $response;
            }

            if ($code === 422) {
                throw new PartneroHttpRequestValidationException($request, $response);
            }

            if ($code === 404) {
                throw new PartneroHttpNotFoundException($request, $response);
            }

            throw new PartneroHttpUnhandledException($request, $response);
        });
    }
}
