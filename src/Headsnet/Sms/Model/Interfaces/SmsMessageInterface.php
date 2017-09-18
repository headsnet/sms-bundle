<?php
declare(strict_types=1);

namespace Headsnet\Sms\Model\Interfaces;

use Esendex\Model\DispatchMessage;
use Symfony\Component\Templating\EngineInterface;

/**
 * Interface SmsMessageInterface
 */
interface SmsMessageInterface
{

	/**
	 * Get Id
	 *
	 * @return int
	 */
	public function getId();

	/**
	 * Get Sender
	 *
	 * @return SmsUserInterface
	 */
	public function getSender();

	/**
	 * Set Sender
	 *
	 * @param SmsUserInterface $mobilePhone
	 *
	 * @return SmsMessageInterface
	 */
	public function setSender(SmsUserInterface $mobilePhone);

	/**
	 * Get Recipient
	 *
	 * @return SmsUserInterface
	 */
	public function getRecipient();

	/**
	 * Set Recipient
	 *
	 * @param SmsUserInterface $mobilePhone
	 *
	 * @return SmsMessageInterface
	 */
	public function setRecipient(SmsUserInterface $mobilePhone);

	/**
	 * Add parameter needed for EngineInterface. You can chain this method to add multiple parameters.
	 *
	 * @param string $key
	 * @param mixed  $value
	 *
	 * @return SmsMessageInterface
	 * @throws \UnexpectedValueException
	 */
	public function addParameter(string $key, $value);

	/**
	 * Get Template
	 *
	 * @return string
	 */
	public function getTemplate();

	/**
	 * Set Template
	 *
	 * @param string $body
	 *
	 * @return SmsMessageInterface
	 */
	public function setTemplate($body);

	/**
	 * Transform MailInterface to Swift_Mime_Message interface
	 *
	 * @param EngineInterface $templating
	 * @param string          $template
	 *
	 * @return DispatchMessage
	 */
	public function transform(EngineInterface $templating, string $template);

	/**
	 * Get MessageId
	 *
	 * @return string
	 */
	public function getMessageId();

	/**
	 * Set MessageId
	 *
	 * @param string $messageId
	 *
	 * @return SmsMessageInterface
	 */
	public function setMessageId($messageId);

	/**
	 * Get Status
	 *
	 * @return string
	 */
	public function getStatus();

	/**
	 * Set Status
	 *
	 * @param string $status
	 *
	 * @return SmsMessageInterface
	 */
	public function setStatus($status);

}
