<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\EventListener;

use Headsnet\EsendexSmsBundle\DependencyInjection\SmsBuilderInterface;
use Headsnet\EsendexSmsBundle\Event\SmsBuildEvent;

/**
 * Listener Class
 */
class SmsBuildListener
{
	/**
	 * @var SmsBuilderInterface
	 */
	private $builder;

	/**
	 * @param SmsBuilderInterface $builder
	 */
	public function __construct(SmsBuilderInterface $builder)
	{
		$this->builder = $builder;
	}

	/**
	 * @param SmsBuildEvent $event
	 */
	public function onMsgSmsBuild(SmsBuildEvent $event)
	{
		$this->builder->build($event);
	}

}
