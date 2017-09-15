<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\Model;

/**
 * Class SmsResultItemInterface
 */
class SmsResultItem implements SmsResultItemInterface
{
	/**
	 * @var string
	 */
	private $id;

	/**
	 * @var string
	 */
	private $uri;

	/**
	 * Get the ID of the message
	 *
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * Set Id
	 *
	 * @param string $id
	 *
	 * @return SmsResultItem
	 */
	public function setId(string $id): SmsResultItem
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the URI of the message
	 *
	 * @return string
	 */
	public function getUri(): string
	{
		return $this->uri;
	}

	/**
	 * Set Uri
	 *
	 * @param string $uri
	 *
	 * @return SmsResultItem
	 */
	public function setUri(string $uri): SmsResultItem
	{
		$this->uri = $uri;

		return $this;
	}

}
