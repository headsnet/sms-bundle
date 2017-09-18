<?php
declare(strict_types=1);

namespace Headsnet\Sms\Model\Interfaces;

/**
 * Value object of an SMS message ready to send
 */
interface TransformedSmsMessageInterface
{
	/**
	 * Get Sender
	 *
	 * @return string
	 */
	public function getSender();

	/**
	 * Get Recipient
	 *
	 * @return string
	 */
	public function getRecipient();

	/**
	 * Get Message
	 *
	 * @return string
	 */
	public function getMessage();
}
