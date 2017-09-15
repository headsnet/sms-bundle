<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\DependencyInjection\SmsSender;

use Headsnet\EsendexSmsBundle\Util\SmsMessageInterface;
use Headsnet\EsendexSmsBundle\Model\SmsResultItem;
use Headsnet\EsendexSmsBundle\Model\SmsResultItemInterface;

/**
 * Class DummySmsService
 */
class DummySmsService implements SmsSenderInterface
{

	/**
	 * Send an SMS message
	 *
	 * @param SmsMessageInterface $message
	 *
	 * @return SmsResultItemInterface
	 *
	 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
	 */
	public function send(SmsMessageInterface $message): SmsResultItemInterface
	{
		$resultItem = new SmsResultItem();
		$resultItem->setId('someId');
		$resultItem->setUri('someUri');

		return $resultItem;
	}

}
