Vulturdev/Cuentica
================

Custom PHP Cuentica library for the Laravel 5 framework - developed by [Vulturdev](http://vulturdev.com).

## Installation

Pull this package using Composer.

```js

    {
        "require": {
            "vulturdev/cuentica": "1.*"
        }
    }

```

or run in terminal:
`composer require vulturdev/cuentica`

### Laravel 5.5+ Integration

Laravel's package discovery will take care of integration for you.


### Laravel 5.* Integration

Add the service provider to your `config/app.php` file:

```php

    'providers'     => array(

        //...
        Vulturdev\Cuentica\CuenticaServiceProvider::class,

    ),

```

## Usage

### Laravel usage

### Set up cuentica token

```php

    // Get the token from the .env file
    $company = new Company;

```

```php

    // Use a variable
    $company = new Company($token);

```

### Sending Company requests

```php

    use Vulturdev\Cuentica\Models\Company;

    $company = new Company;
    print_r($company->company());
    print_r($company->serie());

```

### Sending Account requests

```php

    use Vulturdev\Cuentica\Models\Account;

    $account = new Account;
    print_r($account->accounts());
    print_r($account->account(36528));

```

### Sending Provider requests

```php

    use Vulturdev\Cuentica\Models\Provider;

    $provider = new Provider;
    print_r($provider->providers());
    print_r($provider->providers(array('q' => $search)));
    print_r($provider->providers(array('page_size' => '5','page' => '2')));
    print_r($this->createProvider());
    print_r($provider->provider(377692));
    
    private function createProvider() {
        $provider = new Provider;
        $newProvider = array(
            'address' => 'Address',
            'town' => 'Town',
            'postal_code' => 'PostalCode',
            'cif' => 'Cif',
            'tradename' => 'Tradename',
            'business_name' => 'Business Name',
            'business_type' => 'company',
            'region' => 'alicante',
        );
        print_r($provider->create($newProvider));
    }

```

### Sending Customer requests

```php

    use Vulturdev\Cuentica\Models\Customer;

    $customer = new Customer;
    
    print_r($customer->customers());
    print_r($customer->customers(array('q' => $search)));
    print_r($customer->customers(array('page_size' => '5','page' => '2')));
    print_r($customer->customer(322012));
    print_r($customer->invoices(322012));
    
```

### Sending Invoice requests

```php

    use Vulturdev\Cuentica\Models\Invoice;

    $invoice = new Invoice;
    print_r($invoice->invoices());
    print_r($invoice->sendEmail(686665,array('to' => array($to),'reply_to' => $reply_to,'subject' => $subject,'body' => $body)));
    $invoice->downloadPdf(686665);

```

### Sending Expense requests

```php

    use Vulturdev\Cuentica\Models\Expense;

    $expense = new Expense;
    print_r($expense->expenses());
    print_r($expense->downloadAttachment(786351));

```

## License

This package is open-sourced software licensed under the [GPL-3.0 license](https://opensource.org/licenses/GPL-3.0)

## Contact

For package questions, bug, suggestions and/or feature requests, please use the Github issue system and/or submit a pull request. When submitting an issue, always provide a detailed explanation of your problem, any response or feedback your get, log messages that might be relevant as well as a source code example that demonstrates the problem. If not, I will most likely not be able to help you with your problem.

For any other questions, feel free to use the credentials listed below: 

Víctor Company (developer)

- Email: vcompanyb@vulturdev.com