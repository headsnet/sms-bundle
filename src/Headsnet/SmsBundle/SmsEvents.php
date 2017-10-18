<?php
declare(strict_types=1);

namespace Headsnet\SmsBundle;

/**
 * Class
 */
final class SmsEvents
{
	/**
	 * This event is dispatched when an SMS is confirmed as delivered
	 */
	const DELIVERED = 'headsnet.sms.delivered';

	/**
	 * This event is dispatched when an SMS delivery encounters an error
	 */
	const ERROR = 'headsnet.sms.error';

	/**
	 * This event is dispatched when an SMS is received
	 */
	const RECEIVED = 'headsnet.sms.received';

	/**
	 * This event is dispatched when an SMS is sent
	 */
	const SENT = 'headsnet.sms.sent';

	/**
	 * This event is dispatched when an opt-out request is received
	 */
	const OPT_OUT = 'headsnet.sms.opt_out';

}
