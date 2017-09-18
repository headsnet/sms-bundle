<?php
declare(strict_types=1);

namespace Headsnet\Sms\Factory;

use Headsnet\Sms\Model\Interfaces\SmsUserInterface;
use Headsnet\Sms\Model\SmsMessage;
use Headsnet\Sms\Model\SmsUser;
use libphonenumber\PhoneNumberUtil;

/**
 * Class SmsFactory is responsible for creating all new SMS instances.
 */
class SmsFactory
{
	/**
	 * @var string
	 */
	private $virtualMobileNumber;

	/**
	 * @param string $virtualMobileNumber
	 */
	public function __construct(string $virtualMobileNumber)
	{
		$phoneNumberUtil = PhoneNumberUtil::getInstance();

		$this->virtualMobileNumber = $phoneNumberUtil->parse(
			$virtualMobileNumber,
			PhoneNumberUtil::UNKNOWN_REGION
		);
	}

	/**
	 * @param SmsUserInterface $recipient
	 * @param string           $template
	 *
	 * @return SmsMessage
	 */
	public function create(SmsUserInterface $recipient, string $template)
	{
		$smsMessage = new SmsMessage($template);
		$smsMessage->setRecipient($recipient);

		$smsMessage->setSender(
			new SmsUser($this->virtualMobileNumber, 'Dummy')
		);

		return $smsMessage;
	}

}
