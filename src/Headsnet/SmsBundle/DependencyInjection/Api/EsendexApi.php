<?php
declare(strict_types=1);

namespace Headsnet\SmsBundle\DependencyInjection\Api;

use Headsnet\SmsBundle\Event\SmsApiEvent;
use Headsnet\SmsBundle\SmsEvents;
use Headsnet\SmsBundle\SmsStatus;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Service handles data submitted to our API end point from the Esendex system
 */
class EsendexApi
{
	/**
	 * @var EventDispatcherInterface
	 */
	private $dispatcher;

	/**
	 * @param EventDispatcherInterface $dispatcher
	 */
	public function __construct(EventDispatcherInterface $dispatcher)
	{
		$this->dispatcher = $dispatcher;
	}

	/**
	 * Mark message with specified messageId as status "delivered"
	 *
	 * @param string $messageId
	 */
	public function acknowledgeDeliveryNotification(string $messageId)
	{
		$event = new SmsApiEvent($messageId, SmsStatus::STATUS_DELIVERED);
		$this->dispatcher->dispatch(SmsEvents::SMS_DELIVERED, $event);
	}

	/**
	 * Mark message with specified messageId as status "error"
	 *
	 * @param string $messageId
	 */
	public function logDeliveryError(string $messageId)
	{
		$event = new SmsApiEvent($messageId, SmsStatus::STATUS_ERROR);
		$this->dispatcher->dispatch(SmsEvents::SMS_ERROR, $event);
	}

	/**
	 * Create new SmsMessage record for newly received incoming SMS
	 *
	 * @param string $messageId
	 * @param string $from
	 * @param string $body
	 */
	public function saveReceivedMessage(string $messageId, string $from, string $body)
	{
		$event = new SmsApiEvent($messageId, SmsStatus::STATUS_RECEIVED, $from, $body);
		$this->dispatcher->dispatch(SmsEvents::SMS_RECEIVED, $event);
	}

}
