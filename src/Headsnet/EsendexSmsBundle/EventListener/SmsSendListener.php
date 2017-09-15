<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\EventListener;

use Headsnet\EsendexSmsBundle\DependencyInjection\SmsSender;
use Headsnet\EsendexSmsBundle\Event\SmsSendEvent;

/**
 * Listener Class
 */
class SmsSendListener
{
	/**
	 * @var SmsSender
	 */
	private $sender;

	/**
	 * @param SmsSender $sender
	 */
	public function __construct(SmsSender $sender)
	{
		$this->sender = $sender;
	}

	/**
	 * @param SmsSendEvent $event
	 */
	public function onMsgSmsSend(SmsSendEvent $event)
	{
		$this->sender->send($event);
	}

}
