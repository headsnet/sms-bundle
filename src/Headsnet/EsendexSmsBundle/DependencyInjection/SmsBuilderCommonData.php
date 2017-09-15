<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\DependencyInjection;

use Headsnet\EsendexSmsBundle\Event\SmsBuildEvent;

/**
 * Build the SMS content by adding common template parameters such as company name etc
 */
class SmsBuilderCommonData implements SmsBuilderInterface
{
	/**
	 * @var string
	 */
	private $companyName;

	/**
	 * @var string
	 */
	private $companyEmail;

	/**
	 * @var string
	 */
	private $companyPhone;

	/**
	 * @var string
	 */
	private $brandName;

	/**
	 * @param string $companyName
	 * @param string $companyEmail
	 * @param string $companyPhone
	 * @param string $brandName
	 */
	public function __construct(string $companyName, string $companyEmail, string $companyPhone, string $brandName)
	{
		$this->companyName = $companyName;
		$this->companyEmail = $companyEmail;
		$this->companyPhone = $companyPhone;
		$this->brandName = $brandName;
	}

	/**
	 * @param SmsBuildEvent $event
	 */
	public function build(SmsBuildEvent $event)
	{
		$event->addData('companyName', $this->companyName);
		$event->addData('companyEmail', $this->companyEmail);
		$event->addData('companyPhone', $this->companyPhone);
		$event->addData('brandName', $this->brandName);
	}

}
