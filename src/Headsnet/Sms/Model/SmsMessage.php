<?php
declare(strict_types=1);

namespace Headsnet\Sms\Model;

use Headsnet\Sms\Model\Interfaces\SmsMessageInterface;
use Headsnet\Sms\Model\Interfaces\SmsUserInterface;
use Headsnet\Sms\Model\Interfaces\TransformedSmsMessageInterface;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class SmsMessage
 */
class SmsMessage implements SmsMessageInterface
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var SmsUserInterface
	 */
	private $sender;

	/**
	 * @var SmsUserInterface
	 */
	private $recipient;

	/**
	 * @var string
	 */
	private $messageId;

	/**
	 * @var string
	 */
	private $status;

	/**
	 * @var
	 */
	private $template;

	/**
	 * @var array
	 */
	protected $parameters = array();

	/**
	 * @param string $template
	 */
	public function __construct($template)
	{
		$this->template = $template;
	}

	/**
	 * Get Id
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get Sender
	 *
	 * @return SmsUserInterface
	 */
	public function getSender()
	{
		return $this->sender;
	}

	/**
	 * Set Recipient
	 *
	 * @param SmsUserInterface $sender
	 *
	 * @return SmsMessageInterface
	 */
	public function setSender(SmsUserInterface $sender)
	{
		$this->sender = $sender;

		return $this;
	}

	/**
	 * Get Recipient
	 *
	 * @return SmsUserInterface
	 */
	public function getRecipient()
	{
		return $this->recipient;
	}

	/**
	 * Set Recipient
	 *
	 * @param SmsUserInterface $recipient
	 *
	 * @return SmsMessage
	 */
	public function setRecipient(SmsUserInterface $recipient)
	{
		$this->recipient = $recipient;

		return $this;
	}

	/**
	 * Get Template
	 *
	 * @return mixed
	 */
	public function getTemplate()
	{
		return $this->template;
	}

	/**
	 * Set Template
	 *
	 * @param mixed $template
	 *
	 * @return SmsMessage
	 */
	public function setTemplate($template)
	{
		$this->template = $template;

		return $this;
	}

	/**
	 * @param string $key
	 * @param mixed  $value
	 *
	 * @return $this
	 */
	public function addParameter(string $key, $value)
	{
		if (array_key_exists($key, $this->parameters))
		{
			throw new \UnexpectedValueException('Parameter with the given key already exists.');
		}

		$this->parameters[$key] = $value;

		return $this;
	}

	/**
	 * Get MessageId
	 *
	 * @return string
	 */
	public function getMessageId()
	{
		return $this->messageId;
	}

	/**
	 * Set MessageId
	 *
	 * @param string $messageId
	 *
	 * @return SmsMessageInterface
	 */
	public function setMessageId($messageId)
	{
		$this->messageId = $messageId;

		return $this;
	}

	/**
	 * Get Status
	 *
	 * @return string
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Set Status
	 *
	 * @param string $status
	 *
	 * @return SmsMessageInterface
	 */
	public function setStatus($status)
	{
		$this->status = $status;

		return $this;
	}

	/**
	 * Get user model
	 *
	 * SmsUserInterface might have additional data which is not needed, so it should be transformed to a minimal model
	 * Besides if anything inside user gets changed, the changes will not be visible in the new User object, which is desirable behavior.
	 *
	 * @param SmsUserInterface $user
	 *
	 * @return SmsUser
	 */
	protected function getUserModel(SmsUserInterface $user)
	{
		return new SmsUser($user->getPhoneNumber(), $user->getFullName());
	}

	/**
	 * Transform MailInterface to Swift_Mime_Message interface
	 *
	 * @param EngineInterface $templating
	 * @param string          $template
	 *
	 * @return TransformedSmsMessageInterface
	 */
	public function transform(EngineInterface $templating, string $template)
	{
		$body = $templating->render($template, $this->parameters);

		$phoneNumberUtil = PhoneNumberUtil::getInstance();

		// Send from the VMN
		$sender = $phoneNumberUtil->format(
			$this->sender->getPhoneNumber(),
			PhoneNumberFormat::E164
		);

		$recipient = $phoneNumberUtil->format(
			$this->recipient->getPhoneNumber(),
			PhoneNumberFormat::E164
		);

		return new TransformedSmsMessage($sender, $recipient, $body);
	}

}
