<?php
declare(strict_types=1);

namespace Headsnet\EsendexSmsBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Event Class
 */
class SmsBuildEvent extends Event
{
	/**
	 * Holds any data required to parse the variables in the template
	 *
	 * @var array
	 */
	private $data = [];

	/**
	 * The template file for the body content
	 *
	 * @var string
	 */
	private $template;

	/**
	 * Holds the parsed HTML content as a string
	 *
	 * @var string
	 */
	private $parsed;

	/**
	 * @param array  $data
	 * @param string $tpl
	 */
	public function __construct(array $data, string $tpl)
	{
		$this->data = $data;
		$this->template = $tpl;
	}

	/**
	 * Add Data
	 *
	 * @param string $key
	 * @param mixed  $value
	 */
	public function addData(string $key, $value)
	{
		$this->data[$key] = $value;
	}

	/**
	 * Get Data
	 *
	 * @return array
	 */
	public function getData(): array
	{
		return $this->data;
	}

	/**
	 * Get TemplateText
	 *
	 * @return string
	 */
	public function getTemplate(): string
	{
		return $this->template;
	}

	/**
	 * Get ParsedHtml
	 *
	 * @return string
	 */
	public function getParsed()
	{
		return $this->parsed;
	}

	/**
	 * Set ParsedHtml
	 *
	 * @param string $parsed
	 *
	 * @return SmsBuildEvent
	 */
	public function setParsed(string $parsed): SmsBuildEvent
	{
		$this->parsed = $parsed;

		return $this;
	}

}
