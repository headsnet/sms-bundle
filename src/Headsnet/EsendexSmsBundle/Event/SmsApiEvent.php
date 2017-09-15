<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\Event;

use Headsnet\EsendexSmsBundle\Util\SmsMessageInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Event used when SMS is handled by the SMS API
 */
class SmsApiEvent extends Event
{
	/**
	 * @var SmsMessageInterface
	 */
	private $message;

	/**
	 * @param SmsMessageInterface $message
	 */
	public function __construct(SmsMessageInterface $message)
	{
		$this->message = $message;
	}

	/**
	 * Get Message
	 *
	 * @return SmsMessageInterface
	 */
	public function getMessage(): SmsMessageInterface
	{
		return $this->message;
	}

}
