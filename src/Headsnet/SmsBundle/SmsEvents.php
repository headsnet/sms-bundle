<?php
declare(strict_types=1);

namespace Headsnet\SmsBundle;

/**
 * Class
 */
final class SmsEvents
{
	/**
	 * This event is called by the API when an SMS is confirmed as delivered
	 */
	const SMS_DELIVERED = 'msg.sms.delivered';

	/**
	 * This event is called by the API when an SMS delivery encounters an error
	 */
	const SMS_ERROR = 'msg.sms.error';

	/**
	 * This event is called by the API that receives incoming SMS
	 *
	 * Used to check incoming messages for Therapist confirmations of new bookings
	 */
	const SMS_RECEIVED = 'msg.sms.received';

}
