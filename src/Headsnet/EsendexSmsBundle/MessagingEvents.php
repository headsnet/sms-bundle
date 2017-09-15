<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle;

/**
 * Class
 */
final class MessagingEvents
{
	/**
	 * This event is called when part of the application wants to send an SMS.
	 *
	 * The event holds the details of the message, which is then picked up by the
	 * listener and passed to the SmsSender service
	 */
	const SMS_SEND = 'msg.sms.send';

	/**
	 * This event is called by any service that needs an SMS body template constructing.
	 *
	 * The event can be modified by any listeners needed, to add any data for the template.
	 * The default configuration is for:
	 *
	 *  - a service to add common data, such as reply to phone number
	 *  - a service to parse the template in to a string. This is always the last service to run.
	 */
	const SMS_BUILD_BODY = 'msg.sms.build';

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
