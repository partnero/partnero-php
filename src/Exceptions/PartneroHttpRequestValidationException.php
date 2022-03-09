<?php

declare(strict_types=1);

namespace Partnero\Exceptions;

use JsonException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PartneroHttpRequestValidationException extends PartneroHttpException
{
    /**
     * @var array|mixed
     */
    protected array $errors = [];

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @throws JsonException
     */
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        parent::__construct($request, $response);
        $this->errors = $this->data['errors'] ?? [];
    }

    /**
     * @return array|mixed
     */
    public function getErrors(): mixed
    {
        return $this->errors;
    }
}
