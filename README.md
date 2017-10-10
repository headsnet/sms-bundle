# Symfony Esendex SMS Bundle

Symfony bundle to send and receive SMS messages via the Esendex SMS gateway.

Greatly inspired by the excellent `tomazahlin/symfony-mailer-bundle`
https://github.com/tomazahlin/symfony-mailer-bundle 

## Installation

__Requires Symfony >= 3.3 and PHP >= 7.0__

Install with Composer

`composer require headsnet/sms-bundle`

Add bundle to `AppKernel.php`

```
public function registerBundles()
{
    $bundles = array(
        // ...
        new Headsnet\SmsBundle\HeadsnetSmsBundle(),
    );
}
```

If you need to receive SMS then add the routing configuration in `app/config/routing.yml`

```
headsnet_sms:
  resource: '@HeadsnetSmsBundle/Resources/config/routing.yml'
  prefix:   '/sms'
```

## Configuration

Add required configuration in `app/config.yml`

```
headsnet_sms:
  dispatcher:          esendex
  esendex:
    account_reference: ~
    username:          ~
    password:          ~
    vmn:               ~  # Virtual Mobile Number
```

To simulate SMS sending, you can use the `DummyDispatcher` - for example in your when 
running your test suite - add the following to `app/config_test.yml`

```
headsnet_sms:
  dispatcher: dummy
```

To override the recipient phone number, for example in development, add the following 
to `app/config_dev.yml`

```
headsnet_sms:
  delivery_override:   '+33123456789'
```

### Define SMS message templates

Create a mapping service to link template path definitions to template names

```
<?php
declare(strict_types=1);

namespace AppBundle\Sms;

use Headsnet\Sms\Mapping\TemplateMappingInterface;

/**
 * Map template reference names to template paths
 */
class Mapping implements TemplateMappingInterface
{
	/**
	 * @return array
	 */
	public function getMappings()
	{
		return [
			'customer.confirm' => '@AppBundle/sms/customer.confirm.text.twig',
			'customer.reminder' => '@AppBundle/sms/customer.reminder.text.twig'
		];
	}
}
```

## Sending SMS

To send SMS, inject the SMS sender service in to your code. From here you can access the SMS message factory, or the SMS sender

```
namespace Company\App;

use Headsnet\Sms\SmsSendingInterface;

class MyService
{
    private $smsSending;
        
    public function __construct(SmsSendingInterface $smsSending)
    {
        $this->smsSending = $smsSending;
    }

    public function doSomething()
    {
        // How to access factory to create SMS instances
        $factory = $this->smsSending->getFactory();
        
        // How to access sender to send or queue the SMS
        $smsSender = $this->smsSending->getSmsSender();
    }
}
``` 

### Setting up Push Notifications

If you want the Esendex gateway to phone home with delivery notifications etc, you must 
ensure you have added the bundle's routing in your `routing.yml` file.

Then, in your Esendex control panel, configure the Push Notifications routes with the 
following URLs:

__SMS received__

`https://app.your-domain.com/sms/esendex/message-received`

__SMS delivered__

`https://app.your-domain.com/sms/esendex/delivery-notify`

__SMS failed__

`https://app.your-domain.com/sms/esendex/delivery-error`

__Opt-out__

`https://app.your-domain.com/sms/esendex/opt-out`

These end-points will receive the payload from Esendex and dispatch one of the following events:

  - headsnet.sms.delivered
  - headsnet.sms.error
  - headsnet.sms.received
  - headsnet.sms.opt_out
  
Listeners to these events will receive a `Headsnet\SmsBundle\Event\SmsApiEvent` instance which contains the message data.
