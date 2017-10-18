<?php
declare(strict_types=1);

namespace Headsnet\SmsBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Event is dispatched when the bundle is notified of SMS activity by the gateway.
 */
class SmsEvent extends Event
{
	/**
	 * @var string
	 */
	private $messageId;

	/**
	 * @var string
	 */
	private $recipient;

	/**
	 * @var string
	 */
	private $message;

	/**
	 * @var string
	 */
	private $status;

	/**
	 * @param string      $messageId
	 * @param string      $status
	 * @param string|null $recipient
	 * @param string|null $message
	 */
	public function __construct(string $messageId, string $status, $recipient = null, $message = null)
	{
		$this->messageId = $messageId;
		$this->status = $status;
		$this->recipient = $recipient;
		$this->message = $message;
	}

	/**
	 * Get MessageId
	 *
	 * @return string
	 */
	public function getMessageId(): string
	{
		return $this->messageId;
	}

	/**
	 * Get status
	 *
	 * @return string
	 */
	public function getStatus(): string
	{
		return $this->status;
	}

	/**
	 * Get From
	 *
	 * @return string
	 */
	public function getRecipient()
	{
		return $this->recipient;
	}

	/**
	 * Get Body
	 *
	 * @return string
	 */
	public function getMessage()
	{
		return $this->message;
	}

}
