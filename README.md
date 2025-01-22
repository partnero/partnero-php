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
    * [Archive transaction](#archive-transaction)
    * [Revoke archived transaction](#revoke-archived-transaction)
  * [Webhooks API](#webhooks)
    * [Get a list of webhooks](#get-a-list-of-webhooks)
    * [Get webhook](#get-webhook)
    * [Create webhook](#create-webhook)
    * [Update webhook](#update-webhook)
    * [Delete webhook](#delete-webhook)
  * [Referrals API](#referrals)
    * [Get a list of referrals](#get-a-list-of-referrals)
    * [Create referring customer](#create-referring-customer)
    * [Create referred customer](#create-referred-customer)
    * [Get referral customer](#get-referral-customer)
    * [Get list of referred customers](#get-referred-customer-list)
    * [Get stats of referral customer](#get-referral-customer-stats)
    * [Search referral customer](#search-referral-customer)
    * [Update referral customer](#update-referral-customer)
    * [Delete referral customer](#delete-referral-customer)
    * [Invite referral customer via email](#invite-referral-customer)
    * [Get referral customer balance](#get-referral-customer-balance)
    * [Credit referral customer balance](#credit-referral-customer-balance)
  * [Referral link API](#referral-link)
    * [Get list of referral links](#get-a-list-of-referral-links)
    * [Create referral link](#create-referral-link)
    * [Get referral link](#get-referral-link)
    * [Update referral link](#update-referral-link)
    * [Delete referral link](#delete-referral-link)
    * [Search referral link](#search-referral-link)
  * [Subscribers API](#subscribers)
    * [Get a list of subscribers](#get-a-list-of-subscribers)
    * [Get subscriber](#get-subscriber)
    * [Create subscriber](#create-subscriber)
    * [Update subscriber](#update-subscriber)
    * [Delete subscriber](#delete-subscriber)
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

<a name="archive-transcation"></a>
### Archive transaction

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->transactions()->archive('transaction_123');
```

<a name="revoke-archived-transcation"></a>
### Revoke archived transaction

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->transactions()->revokeArchived('transaction_123');
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

<a name="referrals"></a>
## Referrals

<a name="get-a-list-of-referrals"></a>
### Get a list of referrals

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->referrals()->list(50, 1, 'referred')
```

<a name="create-referring-customer"></a>
### Create referring customer

```php
use Partnero\Partnero;
use Partnero\Models\Partner;

$partnero = new Partnero('api_key');

$customer = (new Partner())
  ->setId('partner-id')
  ->setName('John Doe')
  ->setEmail('john.doe@email.com');

$partnero->referrals()->createReferring($customer);
```

<a name="create-referred-customer"></a>
### Create referred customer

```php
use Partnero\Partnero;
use Partnero\Models\Partner;

$partnero = new Partnero('api_key');

$customer = (new Partner())
  ->setId('partner-id')
  ->setName('Jean Doe')
  ->setEmail('jean.doe@email.com');

$referringCustomer = (new Partner())
  ->setKey('partner-key');

$partnero->referrals()->createReferred($customer, $referringCustomer)
```

<a name="get-referral-customer"></a>
### Get referral customer

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->referrals()->find('partner-id');
```

<a name="get-referred-customer-list"></a>
### Get referred customer list

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->referrals()->listReferred('partner-id');
```

<a name="get-referral-customer-stats"></a>
### Get referral customer stats

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->referrals()->stats('partner-id');
```

<a name="search-referral-customer"></a>
### Search Referral Customer

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->referrals()->search(['id' => 'partner-id']);
```

<a name="update-referral-customer"></a>
### Update referral customer

```php
use Partnero\Partnero;
use Partnero\Models\Partner;

$partnero = new Partnero('api_key');

$newCustomer = (new Partner())
  ->setName('Mark Doe');

$partnero->referrals()->update('partner-id', $newCustomer);
```

<a name="delete-referral-customer"></a>
### Delete referral customer

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->referrals()->delete('partner-id');
```

<a name="invite-referral-customer"></a>
### Invite referral customer

```php
use Partnero\Partnero;
use Partnero\Models\Partner;

$partnero = new Partnero('api_key');

$customer = (new Partner())
  ->setEmail('john.doe@email.com');

$partnero->referrals()->invite($customer, [
  'personalization_key_1' => 'personalization_value_1',
  'personalization_key_2' => 'personalization_value_2'
]);
```

<a name="get-referral-customer-balance"></a>
### Get referral customer balance

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->referrals()->balance('partner-id');
```

<a name="credit-referral-customer-balance"></a>
### Credit referral customer balance

```php
use Partnero\Partnero;
use Partnero\Models\BalanceCredit;

$partnero = new Partnero('api_key');

$credit = (new BalanceCredit())
            ->setAmount(10)
            ->setAmountUnits('usd')
            ->setIsCurrency(true);

$partnero->referrals()->credit('partner-id', $credit);
```

<a name="referral-link"></a>
## Referral link


<a name="get-a-list-of-referral-links"></a>
### Get a list of referral links
```php
use Partnero\Partnero;
use Partnero\Models\ReferralLink;

$partnero = new Partnero('api_key');

$partnero->referralLinks()->list('partner-key', 'limit');
```    


<a name="get-referral-link"></a>
### Get referral link

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->referralLinks()->get('link-id');
```

<a name="create-referral-link"></a>
### Create referral link

```php
use Partnero\Partnero;
use Partnero\Models\ReferralLink;

$partnero = new Partnero('api_key');

$link = (new ReferralLink())
    ->setKey('referral-link-key');

$partner = (new Partner())
  ->setId('partner-id')
  ->setName('Jean Doe')
  ->setEmail('jean.doe@email.com');

// For refer a friend program, add third argument as string 'referral' to create method
$partnero->referralLinks()->create($link, $partner);
```

<a name="update-referral-link"></a>
### Update referral link

```php
use Partnero\Partnero;
use Partnero\Models\ReferralLink;

$partnero = new Partnero('api_key');

$link = (new ReferralLink())
    ->setKey('referral-updated-link-key');

$partnero->referralLinks()->update('link-id', $link);
```

<a name="delete-referral-link"></a>
### Delete referral link

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->referralLinks()->delete('link-id');
```

<a name="search-referral-link"></a>
### Search referral link

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

// use id or key
$partnero->referralLinks()->search(['id' => 'link-id']);
```

<a name="subscriber-api"></a>
## Subscribers

<a name="get-a-list-of-subscribers"></a>
### Get a list of subscribers

```php
use Partnero\Partnero;
use Partnero\Models\Subscriber;

$partnero = new Partnero('api_key');

$partnero->subscribers()->list();
```

<a name="get-subscriber"></a>
### Get subscriber

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->subscribers()->find('subscriber-identifier-or-email');
```

<a name="create-subscriber"></a>
### Create subscriber
```php
use Partnero\Partnero;
use Partnero\Models\Subscriber;

$partnero = new Partnero('api_key');

$subscriber = (new Subscriber())
    ->setName('Referral subscriber')
    ->setEmail('referral@subscriber.com')
    ->setApproved(true)
    ->setStatus('active')
    ->setTos(true)
    ->setMarketingConsent(true);;

$singleSubscriber = $partnero->subscribers()->create($subscriber);

// If you want to create a referred subscriber
$referredSubscriber = (new Subscriber())
    ->setName('Referred Subscriber')
    ->setEmail('referred@subscriber.com')
    ->setApproved(true)
    ->setStatus('active')
    ->setTos(true)
    ->setMarketingConsent(true);
  
$partnero->subscribers()->create($referredSubscriber, $singleSubscriber);
```
> **_NOTE:_** To create a referred subscriber, pass the parent subscriber as the second argument.
If you’re using a response like the one in the example above, make sure to extract the necessary data from the response (e.g., $singleSubscriber['body']['data']).
>
> Alternatively, instead of passing the entire model as a second argument, you can pass the parent subscriber’s identifier or
> email as an array, for example:
```$partnero->subscribers()->create($referredSubscriber, ['email' => 'referral@subscriber.com']).``` 

<a name="update-subscriber"></a>
### Update subscriber

```php
use Partnero\Partnero;
use Partnero\Models\Subscriber;

$partnero = new Partnero('api_key');

$subscriber = (new Subscriber())
  ->setIdentifier('new-subscriber-esp-identifier')
  ->setName('John Surname')
  ->setEmail('subscriber.john.doe@mail.com')
  ->setApproved(true)
  ->setStatus('active')
  ->setTos(false)
  ->setMarketingConsent(false);

$partnero->subscribers()->update('subscriber-identifier-or-email', $subscriber);
```

<a name="delete-subscriber"></a>
### Delete subscriber

```php
use Partnero\Partnero;

$partnero = new Partnero('api_key');

$partnero->subscribers()->delete('subscriber-identifier-or-email');
```

<a name="transactions-api"></a>

<a name="support-and-feedback"></a>
# Support and Feedback

In case you find any bugs, submit an issue directly here in GitHub.

If you have any troubles using our API or SDK feel free to contact our support by email [hello@partnero.com](mailto:hello@partnero.com)

The official documentation is at [https://developers.partnero.com](https://developers.partnero.com)
