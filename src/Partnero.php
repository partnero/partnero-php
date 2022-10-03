<?php

declare(strict_types=1);

namespace Partnero;

use Partnero\Http\HttpLayer;
use Partnero\Endpoints\Test;
use Partnero\Endpoints\Partner;
use Partnero\Endpoints\Partners;
use Partnero\Endpoints\Customer;
use Partnero\Endpoints\Customers;
use Partnero\Endpoints\Settings;
use Partnero\Endpoints\Transactions;
use Partnero\Endpoints\AbstractEndpoint;

class Partnero
{
    public const API_VERSION = 'v1';

    public const OPTION_HOST = 'host';
    public const OPTION_API_PATH = 'api_path';
    public const OPTION_PROTOCOL = 'protocol';

    /**
     * @var string
     */
    protected string $apiKey;

    /**
     * @var HttpLayer
     */
    protected HttpLayer $httpLayer;

    /**
     * @var array
     */
    protected array $options = [];

    /**
     * @var array
     */
    protected static array $defaultOptions = [
        self::OPTION_HOST => 'app.partnero.com',
        self::OPTION_API_PATH => 'api/v1',
        self::OPTION_PROTOCOL => 'https',
    ];

    /**
     * @var AbstractEndpoint|null
     */
    protected ?AbstractEndpoint $test = null;

    /**
     * @var AbstractEndpoint|null
     */
    protected ?AbstractEndpoint $customer = null;

    /**
     * @var AbstractEndpoint|null
     */
    protected ?AbstractEndpoint $customers = null;

    /**
     * @var AbstractEndpoint|null
     */
    protected ?AbstractEndpoint $partner = null;

    /**
     * @var AbstractEndpoint|null
     */
    protected ?AbstractEndpoint $partners = null;

    /**
     * @var AbstractEndpoint|null
     */
    protected ?AbstractEndpoint $settings = null;

    /**
     * @var AbstractEndpoint|null
     */
    protected ?AbstractEndpoint $transactions = null;

    /**
     * @param string $apiKey
     * @param array $options
     */
    public function __construct(string $apiKey, array $options = [])
    {
        $this->apiKey = $apiKey;
        $this->setOptions($options);
        $this->httpLayer = new HttpLayer(
            [
                'security' => [
                    'bearer' => $this->apiKey
                ]
            ]
        );
    }

    /**
     * @param array $options
     * @return void
     */
    protected function setOptions(array $options): void
    {
        $this->options = self::$defaultOptions;
        foreach ($options as $option => $value) {
            $option = strtolower($option);
            if (array_key_exists($option, $this->options)) {
                $this->options[$option] = $value;
            }
        }
    }

    /**
     * @return Test
     */
    public function test(): Test
    {
        if (empty($this->test)) {
            $this->test = new Test($this->httpLayer, $this->options);
        }

        return $this->test;
    }

    /**
     * @return Customer
     * @deprecated use customers
     */
    public function customer(): Customer
    {
        if (empty($this->customer)) {
            $this->customer = new Customer($this->httpLayer, $this->options);
        }

        return $this->customer;
    }

    /**
     * @return Customers
     */
    public function customers(): Customers
    {
        if (empty($this->customers)) {
            $this->customers = new Customers($this->httpLayer, $this->options);
        }

        return $this->customers;
    }

    /**
     * @return Partner
     * @deprecated use partners
     */
    public function partner(): Partner
    {
        if (empty($this->partner)) {
            $this->partner = new Partner($this->httpLayer, $this->options);
        }

        return $this->partner;
    }

    /**
     * @return Partners
     */
    public function partners(): Partners
    {
        if (empty($this->partners)) {
            $this->partners = new Partners($this->httpLayer, $this->options);
        }

        return $this->partners;
    }

    /**
     * @return Transactions
     */
    public function transactions(): Transactions
    {
        if (empty($this->transactions)) {
            $this->transactions = new Transactions($this->httpLayer, $this->options);
        }

        return $this->transactions;
    }

    /**
     * @return Settings
     */
    public function settings(): Settings
    {
        if (empty($this->settings)) {
            $this->settings = new Settings($this->httpLayer, $this->options);
        }

        return $this->settings;
    }
}
