
laravel-mailchimp - MailChimp API V3 
=============

Super-simple, minimum abstraction MailChimp API v3 library for Laravel

Please refer MailChimp API docs to get to know more about the methods available

Requires PHP 7.2+ 

[![Build Status](https://travis-ci.org/rsreedevan/laravel-mailchimp.svg?branch=master)](https://travis-ci.org/drewm/mailchimp-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rsreedevan/laravel-mailchimp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/drewm/mailchimp-api/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/rsreedevan/laravel-mailchimp/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/rsreedevan/laravel-mailchimp/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

Installation
------------

You can install laravel-mailchimp using Composer:

```php
composer require sreedev/laravel-mailchimp
```

You will then need to:
* run ``composer install`` to get these dependencies added to your vendor directory
* publish the config to your application with this line: ``
php artisan vendor:publish --provider="Sreedev\MailChimp\MailChimpServiceProvider" --tag="config"
``
* set the ``MAIL_CHIMP_API_KEY="<YOUR_API_KEY>" `` in the .env file

Examples
--------

Start by `use`-ing the library by adding use 
```php
 use Sreedev\MailChimp\Facades\MailChimp;
 ```
 
Then, list all the mailing lists (with a `get` on the `lists` method)

```php
$result = MailChimp::get('lists');

print_r($result);
```

Subscribe someone to a list (with a `post` to the `lists/{listID}/members` method):

```php
$list_id = 'b1234346';

$result = MailChimp::post("lists/$list_id/members", [
				'email_address' => 'member@example.com',
				'status'        => 'subscribed',
			]);

print_r($result);
```

Update a list member with more information (using `patch` to update):

```php
$list_id = 'b1234346';
$subscriber_hash = MailChimp::subscriberHash('subscriber@example.com');

$result = MailChimp::patch("lists/$list_id/members/$subscriber_hash", [
				'merge_fields' => ['FNAME'=>'First', 'LNAME'=>'Man'],
				'interests'    => ['2s3a384h' => true],
			]);

print_r($result);
```

Remove a list member using the `delete` method:

```php
$list_id = 'b1234346';
$subscriber_hash = MailChimp::subscriberHash('subscriber@example.com');

MailChimp::delete("lists/$list_id/members/$subscriber_hash");
```

Quickly test for a successful action with the `success()` method:

```php
$list_id = 'b1234346';

$result = MailChimp::post("lists/$list_id/members", [
				'email_address' => 'subscriber@example.com',
				'status'        => 'subscribed',
			]);

if (MailChimp::success()) {
	print_r($result);	
} else {
	echo MailChimp::getLastError();
}
```


Troubleshooting
---------------

To get the last error returned by either the HTTP client or by the API, use `getLastError()`:

```php
echo MailChimp::getLastError();
```

For further debugging, you can inspect the headers and body of the response:

```php
print_r(MailChimp::getLastResponse());
```

If you suspect you're sending data in the wrong format, you can look at what was sent to MailChimp by the wrapper:

```php
print_r(MailChimp::getLastRequest());
```

If your server's CA root certificates are not up to date you may find that SSL verification fails and you don't get a response. The correction solution for this [is not to disable SSL verification](http://snippets.webaware.com.au/howto/stop-turning-off-curlopt_ssl_verifypeer-and-fix-your-php-config/). The solution is to update your certificates. 

Contributing
------------

This is a fairly simple wrapper, but it has been made much better by contributions from those using it. If you'd like to suggest an improvement, please raise an issue to discuss it before making your pull request.

Pull requests for bugs are more than welcome - please explain the bug you're trying to fix in the message.

There are a small number of PHPUnit unit tests. To get up and running, copy `.env.example` to `.env` and add your API key details. Unit testing against an API is obviously a bit tricky, but I'd welcome any contributions to this. It would be great to have more test coverage.