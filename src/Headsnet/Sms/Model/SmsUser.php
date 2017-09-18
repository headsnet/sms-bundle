<?php
declare(strict_types=1);

namespace Headsnet\Sms\Model;

use Headsnet\Sms\Model\Interfaces\SmsUserInterface;
use libphonenumber\PhoneNumber;

/**
 * Class SmsUser represents a sender or a recipient of the SMS message
 */
class SmsUser implements SmsUserInterface
{
	/**
	 * @var PhoneNumber
	 */
	private $phoneNumber;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * Constructor
	 *
	 * @param PhoneNumber $phoneNumber
	 * @param string      $name
	 */
	public function __construct(PhoneNumber $phoneNumber, string $name)
	{
		$this->phoneNumber = $phoneNumber;
		$this->name = $name;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getPhoneNumber(): PhoneNumber
	{
		return $this->phoneNumber;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFullName(): string
	{
		return $this->name;
	}

}
