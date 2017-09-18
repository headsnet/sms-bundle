<?php
declare(strict_types=1);

namespace Headsnet\Sms\Dispatcher;

use Headsnet\Sms\Model\Interfaces\TransformedSmsMessageInterface;
use Headsnet\Sms\Model\Interfaces\SmsResultItemInterface;

/**
 * Interface DispatcherInterface
 */
interface DispatcherInterface
{

	/**
	 * @param TransformedSmsMessageInterface $message
	 *
	 * @return SmsResultItemInterface
	 */
	public function send(TransformedSmsMessageInterface $message): SmsResultItemInterface;

}
