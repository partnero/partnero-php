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
  * [Settings API](#settings)
    * [Update setting](#update-setting)
  * [Transactions API](#transactions)
    * [Create transaction](#create-transaction)
    * [Delete transaction](#delete-transaction)
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

$partnero = new Partnero("api_key");

$partnero->partners()->list(limit: 10);
```

<a name="get-partner"></a>
### Get partner

```php
use Partnero\Partnero;

$partnero = new Partnero("api_key");

$partnero->partners()->find(key: 'partner-key');
```

<a name="create-partner"></a>
### Create partner

```php
use Partnero\Partnero;
use Partnero\Models\Partner;

$partnero = new Partnero("api_key");

$partner = (new Partner())
  ->setEmail('test@mail.com')
  ->setName("Name")
  ->setSurname("Surname")
  ->setKey("partner-key");

$partnero->partners()->create($partner);
```

Surname and Key are optional.  
If key is not set, a random key will be generated for the partner.

<a name="update-partner"></a>
### Update partner

```php
use Partnero\Partnero;
use Partnero\Models\Partner;

$partnero = new Partnero("api_key");

$partner = (new Partner())
  ->setEmail('john.doe@mail.com')
  ->setName("John")
  ->setSurname("Doe")
  ->setKey("john-doe");

$partnero->partners()->update(key: 'partner-key', partner: $partner);
```

<a name="delete-partner"></a>
### Delete partner

```php
use Partnero\Partnero;

$partnero = new Partnero("api_key");

$partnero->partners()->delete(key: 'john-doe');
```

<a name="customer-api"></a>
## Customers

<a name="get-a-list-of-customers"></a>
### Get a list of customers

```php
use Partnero\Partnero;
use Partnero\Models\Partner;

$partnero = new Partnero("api_key");

$partner = (new Partner())
    ->setKey('partner-key');

$partnero->customers()->list(limit: 10, partner: $partner);
```

<a name="get-customer"></a>
### Get customer

```php
use Partnero\Partnero;

$partnero = new Partnero("api_key");

$partnero->customers()->find('customer-key');
```

<a name="create-customer"></a>
### Create customer

```php
use Partnero\Partnero;
use Partnero\Models\Partner;
use Partnero\Models\Customer;

$partnero = new Partnero("api_key");

$partner = new Partner();
$partner->setKey('partner-key');

$customer = (new Customer())
  ->setKey("customer-key")
  ->setName("Name")
  ->setSurname("Surname")
  ->setEmail('customer@mail.com');

$partnero->customers()->create($customer, $partner);
```

<a name="update-customer"></a>
### Update customer

```php
use Partnero\Partnero;
use Partnero\Models\Customer;

$partnero = new Partnero("api_key");

$customer = (new Customer())
  ->setKey("new-customer-key")
  ->setName("John")
  ->setSurname("Doe")
  ->setEmail('customer.john.doe@mail.com');

$partnero->customers()->update(key: 'customer-key', customer: $customer);
```

<a name="delete-customer"></a>
### Delete customer

```php
use Partnero\Partnero;

$partnero = new Partnero("api_key");

$partnero->customers()->delete('new-customer-key');
```

<a name="settings-api"></a>
## Settings

<a name="update-setting"></a>
### Update setting

<a name="transactions-api"></a>
## Transactions

<a name="create-transcation"></a>
### Create transaction

```php
use Partnero\Partnero;
use Partnero\Models\Customer;
use Partnero\Models\Transaction;

$partnero = new Partnero("api_key");

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

$partnero = new Partnero("api_key");

$partnero->transactions()->delete(key: 'transaction_123');
```

<a name="support-and-feedback"></a>
# Support and Feedback

In case you find any bugs, submit an issue directly here in GitHub.

If you have any troubles using our API or SDK feel free to contact our support by email [hello@partnero.com](mailto:hello@partnero.com)

The official documentation is at [https://developers.partnero.com](https://developers.partnero.com)