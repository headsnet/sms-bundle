<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\DependencyInjection\SmsSender;

use Headsnet\EsendexSmsBundle\Util\SmsMessageInterface;
use Headsnet\EsendexSmsBundle\Model\SmsResultItemInterface;

/**
 * Interface SmsSenderInterface
 */
interface SmsSenderInterface
{

	/**
	 * Send an SMS message based on the SmsSendEvent
	 *
	 * @param SmsMessageInterface $message
	 *
	 * @return SmsResultItemInterface
	 */
	public function send(SmsMessageInterface $message): SmsResultItemInterface;

}
