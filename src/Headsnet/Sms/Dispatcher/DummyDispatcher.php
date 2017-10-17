<?php
declare(strict_types=1);

namespace Headsnet\Sms\Dispatcher;

use Headsnet\Sms\Model\SmsResultItem;
use Headsnet\Sms\Model\Interfaces\SmsResultItemInterface;
use Headsnet\Sms\Model\Interfaces\TransformedSmsMessageInterface;

/**
 * This dispatcher is used to simulate sending SMS without actually sending anything.
 *
 * Useful when running test suites etc.
 */
class DummyDispatcher implements DispatcherInterface
{

	/**
	 * Send an SMS message
	 *
	 * @param TransformedSmsMessageInterface $message
	 *
	 * @return SmsResultItemInterface
	 *
	 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
	 */
	public function send(TransformedSmsMessageInterface $message): SmsResultItemInterface
	{
		$resultItem = new SmsResultItem();
		$resultItem->setId('someId');
		$resultItem->setUri('someUri');
		$resultItem->setRecipient($message->getRecipient());
		$resultItem->setMessage($message->getMessage());

		return $resultItem;
	}

}
