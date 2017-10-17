<?php
declare(strict_types=1);

namespace Headsnet\Sms\Model;

use Headsnet\Sms\Model\Interfaces\SmsResultItemInterface;

/**
 * Class SmsResultItemInterface
 */
class SmsResultItem implements SmsResultItemInterface
{
	/**
	 * @var string
	 */
	private $id;

	/**
	 * @var string
	 */
	private $uri;

	/**
	 * @var string
	 */
	private $recipient;

	/**
	 * @var string
	 */
	private $message;

	/**
	 * Get the ID of the message
	 *
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * Set Id
	 *
	 * @param string $id
	 *
	 * @return SmsResultItem
	 */
	public function setId(string $id): SmsResultItem
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the URI of the message
	 *
	 * @return string
	 */
	public function getUri(): string
	{
		return $this->uri;
	}

	/**
	 * Set Uri
	 *
	 * @param string $uri
	 *
	 * @return SmsResultItem
	 */
	public function setUri(string $uri): SmsResultItem
	{
		$this->uri = $uri;

		return $this;
	}

	/**
	 * Get Recipient
	 *
	 * @return string
	 */
	public function getRecipient(): string
	{
		return $this->recipient;
	}

	/**
	 * Set Recipient
	 *
	 * @param string $recipient
	 *
	 * @return SmsResultItem
	 */
	public function setRecipient(string $recipient): SmsResultItem
	{
		$this->recipient = $recipient;

		return $this;
	}

	/**
	 * Get Message
	 *
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}

	/**
	 * Set Message
	 *
	 * @param string $message
	 *
	 * @return SmsResultItem
	 */
	public function setMessage(string $message): SmsResultItem
	{
		$this->message = $message;

		return $this;
	}

}
