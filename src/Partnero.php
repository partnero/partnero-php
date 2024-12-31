<?php

declare(strict_types=1);

namespace Partnero;

use Partnero\Endpoints\Customer;
use Partnero\Endpoints\ReferralLinks;
use Partnero\Endpoints\Subscribers;
use Partnero\Http\HttpLayer;
use Partnero\Endpoints\Test;
use Partnero\Endpoints\Partners;
use Partnero\Endpoints\Customers;
use Partnero\Endpoints\Settings;
use Partnero\Endpoints\Transactions;
use Partnero\Endpoints\Webhooks;
use Partnero\Endpoints\Referrals;

class Partnero
{
    public const API_VERSION = 'v1';
    public const SDK_VERSION = 'v1.0.23';

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
        self::OPTION_HOST => 'api.partnero.com',
        self::OPTION_API_PATH => 'v1',
        self::OPTION_PROTOCOL => 'https',
    ];

    /**
     * @var Test|null
     */
    protected ?Test $test = null;

    /**
     * @var Customer|null
     */
    protected ?Customer $customer = null;

    /**
     * @var Customers|null
     */
    protected ?Customers $customers = null;

    /**
     * @var Partners|null
     */
    protected ?Partners $partners = null;

    /**
     * @var Settings|null
     */
    protected ?Settings $settings = null;

    /**
     * @var Transactions|null
     */
    protected ?Transactions $transactions = null;

    /**
     * @var ReferralLinks|null
     */
    protected ?ReferralLinks $referralLinks = null;

    /**
     * @var Webhooks|null
     */
    protected ?Webhooks $webhooks = null;

    /**
     * @var Referrals|null
     */
    protected ?Referrals $referrals = null;

    /**
     * @var Subscribers|null
     */
    protected ?Subscribers $subscribers = null;

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
     * @return Customer
     * @deprecated
     */
    public function customer(): Customer
    {
        if (empty($this->customer)) {
            $this->customer = new Customer($this->httpLayer, $this->options);
        }

        return $this->customer;
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
     * @return Partners
     */
    public function partner(): Partners
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
     * @return ReferralLinks
     */
    public function referralLinks(): ReferralLinks
    {
        if (empty($this->referralLinks)) {
            $this->referralLinks = new ReferralLinks($this->httpLayer, $this->options);
        }

        return $this->referralLinks;
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

    /**
     * @return Webhooks
     */
    public function webhooks(): Webhooks
    {
        if (empty($this->webhooks)) {
            $this->webhooks = new Webhooks($this->httpLayer, $this->options);
        }

        return $this->webhooks;
    }

    /**
     * @return Referrals
     */
    public function referrals(): Referrals
    {
        if (empty($this->referrals)) {
            $this->referrals = new Referrals($this->httpLayer, $this->options);
        }

        return $this->referrals;
    }

    /**
     * @return Subscribers
     */
    public function subscribers(): Subscribers
    {
        if (empty($this->subscribers)) {
            $this->subscribers = new Subscribers($this->httpLayer, $this->options);
        }

        return $this->subscribers;
    }
}
