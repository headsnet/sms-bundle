<?php
declare(strict_types=1);

namespace Headsnet\Sms\Model\Interfaces;

/**
 * Interface SmsResultItemInterface
 */
interface SmsResultItemInterface
{

	/**
	 * Get the ID of the message
	 *
	 * @return string
	 */
	public function getId(): string;

	/**
	 * Get the URI of the message
	 *
	 * @return string
	 */
	public function getUri(): string;

}
