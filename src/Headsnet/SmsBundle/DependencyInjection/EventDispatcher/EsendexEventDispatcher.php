<?php
declare(strict_types=1);

namespace Headsnet\SmsBundle\DependencyInjection\EventDispatcher;

use Headsnet\SmsBundle\Event\SmsEvent;
use Headsnet\SmsBundle\SmsEvents;
use Headsnet\SmsBundle\SmsStatus;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Service handles data submitted to our API end point from the Esendex system
 */
class EsendexEventDispatcher
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
		$event = new SmsEvent($messageId, SmsStatus::STATUS_DELIVERED);
		$this->dispatcher->dispatch(SmsEvents::DELIVERED, $event);
	}

	/**
	 * Mark message with specified messageId as status "error"
	 *
	 * @param string $messageId
	 */
	public function logDeliveryError(string $messageId)
	{
		$event = new SmsEvent($messageId, SmsStatus::STATUS_ERROR);
		$this->dispatcher->dispatch(SmsEvents::ERROR, $event);
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
		$event = new SmsEvent($messageId, SmsStatus::STATUS_RECEIVED, $from, $body);
		$this->dispatcher->dispatch(SmsEvents::RECEIVED, $event);
	}

	/**
	 * Create new SmsMessage record for newly received incoming SMS
	 *
	 * @param string $messageId
	 * @param string $from
	 * @param string $body
	 */
	public function optOut(string $messageId, string $from, string $body)
	{
		$event = new SmsEvent($messageId, SmsStatus::STATUS_RECEIVED, $from, $body);
		$this->dispatcher->dispatch(SmsEvents::OPT_OUT, $event);
	}

}
