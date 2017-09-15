<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\DependencyInjection;

use Headsnet\EsendexSmsBundle\Event\SmsBuildEvent;

/**
 * Build the email content by parsing the twig templates
 */
class SmsBuilderParser implements SmsBuilderInterface
{
	/**
	 * @var \Twig_Environment
	 */
	private $twig;

	/**
	 * @param \Twig_Environment $twig
	 */
	public function __construct(\Twig_Environment $twig)
	{
		$this->twig = $twig;
	}

	/**
	 * @param SmsBuildEvent $event
	 */
	public function build(SmsBuildEvent $event)
	{
		$event->setParsed(
			$this->twig->render(
				$event->getTemplate(),
			    $event->getData()
			)
		);
	}

}
