<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\Event;

use Headsnet\EsendexSmsBundle\Util\SmsMessageInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Event Class
 */
class SmsSendEvent extends Event
{
	/**
	 * @var SmsMessageInterface
	 */
	private $message;

	/**
	 * @var bool
	 */
	private $response = false;

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

	/**
	 * Get Response
	 *
	 * @return bool
	 */
	public function getResponse(): bool
	{
		return $this->response;
	}

	/**
	 * Set Response
	 *
	 * @param bool $response
	 *
	 * @return SmsSendEvent
	 */
	public function setResponse(bool $response): SmsSendEvent
	{
		$this->response = $response;

		return $this;
	}

}
