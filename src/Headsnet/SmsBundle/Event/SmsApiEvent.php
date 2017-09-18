<?php
declare(strict_types=1);

namespace Headsnet\SmsBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Event used when SMS is handled by the SMS API
 */
class SmsApiEvent extends Event
{
	/**
	 * @var string
	 */
	private $messageId;

	/**
	 * @var string
	 */
	private $from;

	/**
	 * @var string
	 */
	private $body;

	/**
	 * @var string
	 */
	private $status;

	/**
	 * @param string      $messageId
	 * @param string      $status
	 * @param string|null $from
	 * @param string|null $body
	 */
	public function __construct(string $messageId, string $status, $from = null, $body = null)
	{
		$this->messageId = $messageId;
		$this->status = $status;
		$this->from = $from;
		$this->body = $body;
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
	public function getFrom()
	{
		return $this->from;
	}

	/**
	 * Get Body
	 *
	 * @return string
	 */
	public function getBody()
	{
		return $this->body;
	}

}
