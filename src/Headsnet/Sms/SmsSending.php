<?php
declare(strict_types=1);

namespace Headsnet\Sms;

use Headsnet\Sms\Factory\SmsFactory;

/**
 * Class SmsSending is a composite class which holds SmsSender and the Factory,
 * so only one service is publicly exposed and to be injected in other services
 */
class SmsSending implements SmsSendingInterface
{
    /**
     * @var SmsSenderInterface
     */
    private $smsSender;

    /**
     * @var SmsFactory
     */
    private $factory;

    /**
     * Constructor.
     *
     * @param SmsSenderInterface $smsSender
     * @param SmsFactory         $factory
     */
    public function __construct(SmsSenderInterface $smsSender, SmsFactory $factory)
    {
        $this->smsSender = $smsSender;
        $this->factory = $factory;
    }

    /**
     * {@inheritDoc}
     */
    public function getSmsSender()
    {
        return $this->smsSender;
    }

    /**
     * {@inheritDoc}
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
