<?php
declare(strict_types=1);

namespace Headsnet\Sms\Dispatcher;

use Esendex\DispatchService;
use Esendex\Model\DispatchMessage;
use Esendex\Model\Message;
use Headsnet\Sms\Model\Interfaces\SmsResultItemInterface;
use Headsnet\Sms\Model\Interfaces\TransformedSmsMessageInterface;
use Headsnet\Sms\Model\SmsResultItem;

/**
 * This dispatcher uses the EsendexSDK to send SMS messages via the Esendex SMS gateway
 */
class EsendexDispatcher extends AbstractDispatcher implements DispatcherInterface
{
	/**
	 * @var DispatchService
	 */
	private $dispatcher;

	/**
	 * @param DispatchService $dispatcher
	 * @param string|null     $deliveryOverride
	 */
	public function __construct(DispatchService $dispatcher, $deliveryOverride = null)
	{
		$this->dispatcher = $dispatcher;
		$this->deliveryOverride = $deliveryOverride;
	}

	/**
	 * Send an SMS message via the Esendex API
	 *
	 * @param TransformedSmsMessageInterface $message
	 *
	 * @return SmsResultItemInterface
	 */
	public function send(TransformedSmsMessageInterface $message): SmsResultItemInterface
	{
		// Remove the + sign from the start of the number
		$sender = str_replace('+', '', $message->getSender());

		$message = new DispatchMessage(
			$sender, // Send from the VMN
			$this->doDeliveryOverride($message->getRecipient()),
			$message->getMessage(),
			Message::SmsType
		);

		$response = $this->dispatcher->send($message);

		$resultItem = new SmsResultItem();
		$resultItem->setId($response->id());
		$resultItem->setUri($response->uri());

		return $resultItem;
	}

}
