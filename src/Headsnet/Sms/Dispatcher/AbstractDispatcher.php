<?php
declare(strict_types=1);

namespace Headsnet\Sms\Dispatcher;

/**
 * AbstractDispatcher
 */
class AbstractDispatcher
{
	/**
	 * @var string|null
	 */
	protected $deliveryOverride;

	/**
	 * Override the recipient if the deliveryOverride
	 * option is set in the configuration
	 *
	 * @param string $recipient
	 *
	 * @return string
	 */
	protected function doDeliveryOverride(string $recipient)
	{
		if ($this->deliveryOverride)
		{
		    return $this->deliveryOverride;
		}

		return $recipient;
	}

}
