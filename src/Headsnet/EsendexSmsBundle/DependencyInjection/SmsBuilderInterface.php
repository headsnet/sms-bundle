<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\DependencyInjection;

use Headsnet\EsendexSmsBundle\Event\SmsBuildEvent;

/**
 * Interface SmsBuilderInterface
 */
interface SmsBuilderInterface
{

	/**
	 * Perform actions on the SmsBuildEvent
	 *
	 * @param SmsBuildEvent $event
	 */
	public function build(SmsBuildEvent $event);

}
