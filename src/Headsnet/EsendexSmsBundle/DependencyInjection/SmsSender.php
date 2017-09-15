<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\DependencyInjection;

use Doctrine\ORM\EntityManagerInterface;
use Headsnet\EsendexSmsBundle\MessageStatus;
use libphonenumber\PhoneNumberUtil;
use Headsnet\EsendexSmsBundle\DependencyInjection\SmsSender\SmsSenderInterface;
use Headsnet\EsendexSmsBundle\Util\SmsMessageInterface;
use Headsnet\EsendexSmsBundle\Event\SmsSendEvent;

/**
 * Service called by event listener to send SMS in SmsSend events
 */
class SmsSender
{
	/**
	 * @var SmsSenderInterface
	 */
	private $sender;

	/**
	 * @var EntityManagerInterface
	 */
	private $em;

	/**
	 * @var SmsMessageInterface
	 */
	private $message;

	/**
	 * @var null|string
	 */
	private $deliveryOverride;

	/**
	 * @param SmsSenderInterface     $sender
	 * @param EntityManagerInterface $em
	 * @param string                 $deliveryOverride
	 */
	public function __construct(
		SmsSenderInterface     $sender,
		EntityManagerInterface $em,
		$deliveryOverride
	)
	{
		$this->sender = $sender;
		$this->em = $em;
		$this->deliveryOverride = $deliveryOverride;
	}

	/**
	 * @param SmsSendEvent $event
	 */
	public function send(SmsSendEvent $event)
	{
		$this->message = $event->getMessage();

		if ($this->deliveryOverride)
		{
			$phoneNumberUtil = PhoneNumberUtil::getInstance();
		    $this->message->setPhoneNumber($phoneNumberUtil->parse($this->deliveryOverride, 'GB'));
		}

		if ($response = $this->sender->send($this->message))
		{
			$this->message->setStatus(MessageStatus::STATUS_SENT);
			$this->message->setMessageId($response->getId());
			$this->em->persist($this->message);
			$this->em->flush();

		    $event->setResponse(true);
		}
		else
		{
			$event->setResponse(false);
		}
	}

}
