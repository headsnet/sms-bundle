<?php
declare(strict_types=1);

namespace Headsnet\Sms\Model\Interfaces;

use libphonenumber\PhoneNumber;

/**
 * Interface SmsUserInterface
 */
interface SmsUserInterface
{

	/**
	 * Constructor
	 *
	 * @param PhoneNumber $phoneNumber
	 * @param string      $name
	 */
	public function __construct(PhoneNumber $phoneNumber, string $name);

	/**
	 * @return PhoneNumber
	 */
	public function getPhoneNumber(): PhoneNumber;

	/**
	 * @return string
	 */
	public function getFullName(): string;

}
