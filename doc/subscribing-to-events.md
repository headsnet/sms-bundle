# Subscribing to events

The bundle dispatches events when push notifications are received from the gateway, 
for example when a message has been received. This keeps things nice and decoupled 
from your application.

You can listen for these events in your application, and execute whatever you need 
using a standard Symfony event subscriber.

Below is a simple example of the event subscriber class that you can use in your app.

```
<?php

namespace AppBundle\EventListener;

use Headsnet\SmsBundle\Event\SmsEvent;
use Headsnet\SmsBundle\SmsEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class
 */
class SmsPushNotificationSubscriber implements EventSubscriberInterface
{

	/**
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		return [
			SmsEvents::DELIVERED => 'onSmsDelivered',
			SmsEvents::ERROR     => 'onSmsError',
			SmsEvents::RECEIVED  => 'onSmsReceived',
			SmsEvents::OPT_OUT   => 'onSmsOptOut'
		];
	}

	/**
	 * @param SmsEvent $event
	 */
	public function onSmsDelivered(SmsEvent $event)
	{
		// your functionality here
	}

	/**
	 * @param SmsEvent $event
	 */
	public function onSmsError(SmsEvent $event)
	{
		// your functionality here
	}

	/**
	 * @param SmsEvent $event
	 */
	public function onSmsReceived(SmsEvent $event)
	{
		// your functionality here
	}

	/**
	 * @param SmsEvent $event
	 */
	public function onSmsOptOut(SmsEvent $event)
	{
		// your functionality here
	}

}

```
