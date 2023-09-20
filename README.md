Partnero PHP SDK

[![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](/LICENSE)

# Table of Contents

* [Installation](#installation)
* [Usage](#usage)
  * [Partners API](#partners-for-affiliate-program)
    * [Get a list of partners](#get-a-list-of-partners)
    * [Get partner](#get-partner)
    * [Create partner](#create-partner)
    * [Update partner](#update-partner)
    * [Delete partner](#delete-partner)
  * [Customers API](#customers)
    * [Get a list of customers](#get-a-list-of-customers)
    * [Get customer](#get-customer)
    * [Create customer](#create-customer)
    * [Update customer](#update-customer)
    * [Delete customer](#delete-customer)
  * [Transactions API](#transactions)
    * [Create transaction](#create-transaction)
    * [Delete transaction](#delete-transaction)
  * [Webhooks API](#webhooks)
    * [Get a list of webhooks](#get-a-list-of-webhooks)
    * [Get webhook](#get-webhook)
    * [Create webhook](#create-webhook)
    * [Update webhook](#update-webhook)
    * [Delete webhook](#delete-webhook)
* [Support and Feedback](#support-and-feedback)

# Installation

## Requirements

- PHP 8.0
- PSR-7 and PSR-18 based HTTP adapter
- Partnero API key [partnero.com](https://www.partnero.com)

## Setup

This library is built atop of [PSR-7](https://www.php-fig.org/psr/psr-7/) and
[PSR-18](https://www.php-fig.org/psr/psr-18/).

```bash
composer require partnero/partnero-php
```

<a name="usage"></a>
# Usage

<a name="partners-api"></a>
## Partners for Affiliate program

<a name="get-a-list-of-partners"></a>
### Get a list of partners

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->partners()->list(10);
```

<a name="get-partner"></a>
### Get partner

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->partners()->find('partner-key');
```

<a name="create-partner"></a>
### Create partner

```php
use Partnero\Partnero;
use Partnero\Models\Partner;

$partnero = new Partnero('api_key');

$partner = (new Partner())
  ->setEmail('test@mail.com')
  ->setName('Name')
  ->setKey('partner-key');

$partnero->partners()->create($partner);
```

Key is optional.  
If key is not set, a random key will be generated for the partner.

<a name="update-partner"></a>
### Update partner

```php
use Partnero\Partnero;
use Partnero\Models\Partner;

$partnero = new Partnero('api_key');

$partner = (new Partner())
  ->setEmail('john.doe@mail.com')
  ->setName('John')
  ->setKey('john-doe');

$partnero->partners()->update('partner-key', $partner);
```

<a name="delete-partner"></a>
### Delete partner

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->partners()->delete('john-doe');
```

<a name="customer-api"></a>
## Customers

<a name="get-a-list-of-customers"></a>
### Get a list of customers

```php
use Partnero\Partnero;
use Partnero\Models\Partner;

$partnero = new Partnero('api_key');

$partner = (new Partner())
  ->setKey('partner-key');

$partnero->customers()->list(10, $partner);
```

<a name="get-customer"></a>
### Get customer

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->customers()->find('customer-key');
```

<a name="create-customer"></a>
### Create customer

```php
use Partnero\Partnero;
use Partnero\Models\Partner;
use Partnero\Models\Customer;

$partnero = new Partnero('api_key');

$partner = new Partner();
$partner->setKey('partner-key');

$customer = (new Customer())
  ->setKey('customer-key')
  ->setName('Name')
  ->setEmail('customer@mail.com');

$partnero->customers()->create($customer, $partner);
```

<a name="update-customer"></a>
### Update customer

```php
use Partnero\Partnero;
use Partnero\Models\Customer;

$partnero = new Partnero('api_key');

$customer = (new Customer())
  ->setKey('new-customer-key')
  ->setName('John')
  ->setEmail('customer.john.doe@mail.com');

$partnero->customers()->update('customer-key', $customer);
```

<a name="delete-customer"></a>
### Delete customer

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->customers()->delete('new-customer-key');
```

<a name="transactions-api"></a>
## Transactions

<a name="create-transcation"></a>
### Create transaction

```php
use Partnero\Partnero;
use Partnero\Models\Customer;
use Partnero\Models\Transaction;

$partnero = new Partnero('api_key');

$customer = (new Customer())
  ->setKey('customer-key');

$transaction = (new Transaction())
  ->setKey('transaction_123')
  ->setAmount(99.99)
  ->setAction('sale');

$partnero->transactions()->create($transaction, $customer);
```

<a name="delete-transcation"></a>
### Delete transaction

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->transactions()->delete('transaction_123');
```

<a name="webhooks"></a>
## Webhooks

<a name="get-a-list-of-webhooks"></a>
### Get a list of webhooks

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->webhooks()->list(50, 1);
```

<a name="get-webhook"></a>
### Get webhook

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->webhooks()->find('webhook-key');
```

<a name="create-webhook"></a>
### Create webhook

```php
use Partnero\Partnero;
use Partnero\Models\Webhook;

$partnero = new Partnero('api_key');

$webhook = (new Webhook())
  ->setName('Demo')
  ->setUrl('https://webhook.site/e68d154a-ad82')
  ->setEvents([
    'partner.created'
  ]);

$partnero->webhooks()->create($webhook);
```

<a name="update-webhook"></a>
### Update webhook

```php
use Partnero\Partnero;
use Partnero\Models\Webhook;

$partnero = new Partnero('api_key');

$webhook = (new Webhook())->setName('Demo 2');

$partnero->webhooks()->update('webhook-key', $webhook);
```

<a name="delete-webhook"></a>
### Delete webhook

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->webhooks()->delete('webhook-key');
```

<a name="support-and-feedback"></a>
# Support and Feedback

In case you find any bugs, submit an issue directly here in GitHub.

If you have any troubles using our API or SDK feel free to contact our support by email [hello@partnero.com](mailto:hello@partnero.com)

The official documentation is at [https://developers.partnero.com](https://developers.partnero.com)
