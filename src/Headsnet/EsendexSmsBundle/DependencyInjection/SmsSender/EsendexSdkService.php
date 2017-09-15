<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\DependencyInjection\SmsSender;

use Esendex\DispatchService;
use Esendex\Model\DispatchMessage;
use Esendex\Model\Message;
use libphonenumber\PhoneNumberFormat;
use Headsnet\EsendexSmsBundle\Util\SmsMessageInterface;
use Headsnet\EsendexSmsBundle\Model\SmsResultItem;
use Headsnet\EsendexSmsBundle\Model\SmsResultItemInterface;
use Misd\PhoneNumberBundle\Templating\Helper\PhoneNumberFormatHelper;

/**
 * Class EsendexSdkService
 */
class EsendexSdkService implements SmsSenderInterface
{
	/**
	 * @var DispatchService
	 */
	private $dispatcher;

	/**
	 * @var PhoneNumberFormatHelper
	 */
	protected $phoneNumberFormatHelper;

	/**
	 * @var string
	 */
	private $virtualMobileNumber;

	/**
	 * @param DispatchService         $dispatcher
	 * @param PhoneNumberFormatHelper $phoneNumberFormatHelper
	 * @param string                  $virtualMobileNumber
	 */
	public function __construct(
		DispatchService         $dispatcher,
		PhoneNumberFormatHelper $phoneNumberFormatHelper,
		string                  $virtualMobileNumber
	)
	{
		$this->dispatcher = $dispatcher;
		$this->phoneNumberFormatHelper = $phoneNumberFormatHelper;
		$this->virtualMobileNumber = $virtualMobileNumber;
	}

	/**
	 * Send an SMS message via the Esendex API
	 *
	 * @param SmsMessageInterface $message
	 *
	 * @return SmsResultItemInterface
	 */
	public function send(SmsMessageInterface $message): SmsResultItemInterface
	{
		$message = new DispatchMessage(
			$this->virtualMobileNumber, // Send from
			$this->phoneNumberFormatHelper->format($message->getPhoneNumber(), PhoneNumberFormat::INTERNATIONAL),
			$message->getBody(),
			Message::SmsType
		);

		$response = $this->dispatcher->send($message);

		$resultItem = new SmsResultItem();
		$resultItem->setId($response->id());
		$resultItem->setUri($response->uri());

		return $resultItem;
	}

}
