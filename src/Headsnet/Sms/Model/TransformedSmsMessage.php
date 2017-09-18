<?php
declare(strict_types=1);

namespace Headsnet\Sms\Model;

use Headsnet\Sms\Model\Interfaces\TransformedSmsMessageInterface;

/**
 * Value object of an SMS message ready to send
 */
class TransformedSmsMessage implements TransformedSmsMessageInterface
{
	/**
	 * @var string
	 */
	public $sender;

	/**
	 * @var string
	 */
	public $recipient;

	/**
	 * @var string
	 */
	public $message;

	/**
	 * @param string $sender
	 * @param string $recipient
	 * @param string $message
	 */
	public function __construct(string $sender, string $recipient, string $message)
	{
		$this->sender = $sender;
		$this->recipient = $recipient;
		$this->message = $message;
	}

	/**
	 * Get Sender
	 *
	 * @return string
	 */
	public function getSender()
	{
		return $this->sender;
	}

	/**
	 * Get Recipient
	 *
	 * @return string
	 */
	public function getRecipient()
	{
		return $this->recipient;
	}

	/**
	 * Get Message
	 *
	 * @return string
	 */
	public function getMessage()
	{
		return $this->message;
	}

}
