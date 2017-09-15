<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\DependencyInjection\Api;

use Doctrine\ORM\EntityManagerInterface;
use libphonenumber\PhoneNumberUtil;
use Headsnet\EsendexSmsBundle\Entity\SmsMessage;
use Headsnet\EsendexSmsBundle\Event\SmsApiEvent;
use Headsnet\EsendexSmsBundle\MessagingEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Service handles data submitted to our API end point from the Esendex system
 */
class EsendexApi
{
	const BANNED_SENDERS = ['20265'];

	/**
	 * @var EntityManagerInterface
	 */
	private $em;

	/**
	 * @var EventDispatcherInterface
	 */
	private $dispatcher;

	/**
	 * @param EntityManagerInterface   $em
	 * @param EventDispatcherInterface $dispatcher
	 */
	public function __construct(
		EntityManagerInterface   $em,
		EventDispatcherInterface $dispatcher
	)
	{
		$this->em = $em;
		$this->dispatcher = $dispatcher;
	}

	/**
	 * Mark message with specified messageId as status "delivered"
	 *
	 * @param string $messageId
	 *
	 * @return bool
	 */
	public function acknowledgeDeliveryNotification(string $messageId): bool
	{
		/** @var SmsMessage $smsMessage */
		$smsMessage = $this->em->getRepository('HeadsnetEsendexSmsBundle:SmsMessage')->findOneBy([
			'messageId' => $messageId
		]);

		if ($smsMessage)
		{
			$smsMessage->setStatus(SmsMessage::STATUS_DELIVERED);
			$this->em->persist($smsMessage);
			$this->em->flush();

			$event = new SmsApiEvent($smsMessage);
			$this->dispatcher->dispatch(MessagingEvents::SMS_DELIVERED, $event);

			return true;
		}

		return false;
	}

	/**
	 * Mark message with specified messageId as status "error"
	 *
	 * @param string $messageId
	 *
	 * @return bool
	 */
	public function logDeliveryError(string $messageId): bool
	{
		/** @var SmsMessage $smsMessage */
		$smsMessage = $this->em->getRepository('HeadsnetEsendexSmsBundle:SmsMessage')->findOneBy([
            'messageId' => $messageId
        ]);

		if ($smsMessage)
		{
			$smsMessage->setStatus(SmsMessage::STATUS_ERROR);
			$this->em->persist($smsMessage);
			$this->em->flush();

			$event = new SmsApiEvent($smsMessage);
			$this->dispatcher->dispatch(MessagingEvents::SMS_ERROR, $event);

			return true;
		}

		return false;
	}

	/**
	 * Create new SmsMessage record for newly received incoming SMS
	 *
	 * @param string $messageId
	 * @param string $from
	 * @param string $body
	 *
	 * @return bool
	 */
	public function saveReceivedMessage(string $messageId, string $from, string $body): bool
	{
		if ($this->validateReceivedMessage($from))
		{
			$phoneNumberUtil = PhoneNumberUtil::getInstance();

			$smsMessage = new SmsMessage();
			$smsMessage->setMessageId($messageId);
			$smsMessage->setPhoneNumber($phoneNumberUtil->parse($from, 'GB'));
			$smsMessage->setBody($body);
			$smsMessage->setStatus(SmsMessage::STATUS_RECEIVED);

			$this->em->persist($smsMessage);
			$this->em->flush();

			$event = new SmsApiEvent($smsMessage);
			$this->dispatcher->dispatch(MessagingEvents::SMS_RECEIVED, $event);

			return true;
		}

		return false;
	}

	/**
	 * Validate incoming message. Return false if it's noise and to be ignored
	 *
	 * @param string $from
	 *
	 * @return bool
	 */
	private function validateReceivedMessage(string $from): bool
	{
		if (in_array($from, self::BANNED_SENDERS))
		{
			return false;
		}

		return true;
	}

}
