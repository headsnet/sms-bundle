<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\Util;

use libphonenumber\PhoneNumber;

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
	 * Get Recipients
	 *
	 * @return PhoneNumber
	 */
	public function getPhoneNumber();

	/**
	 * Set Recipient
	 *
	 * @param PhoneNumber $mobilePhone
	 *
	 * @return SmsMessageInterface
	 */
	public function setPhoneNumber(PhoneNumber $mobilePhone);

	/**
	 * Get BodyHtml
	 *
	 * @return string
	 */
	public function getBody();

	/**
	 * Set BodyHtml
	 *
	 * @param string $body
	 *
	 * @return SmsMessageInterface
	 */
	public function setBody($body);

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
