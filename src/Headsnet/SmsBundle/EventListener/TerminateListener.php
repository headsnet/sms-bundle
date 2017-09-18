<?php
declare(strict_types=1);

namespace Headsnet\SmsBundle\EventListener;

use Headsnet\Sms\QueueableSmsSenderInterface;
use Headsnet\Sms\SmsSenderInterface;

/**
 * Class TerminateListener listens to kernel.terminate event and sends
 * (forwards) all the queued SMS to the SMS sender (ex. Esendex DispatchService)
 */
class TerminateListener
{
    /**
     * @var SmsSenderInterface
     */
    private $mailer;

    /**
     * @param SmsSenderInterface $mailer
     */
    public function __construct(SmsSenderInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Sends all mail from the queue, only if the mailer supports it
     */
    public function execute()
    {
        if ($this->mailer instanceof QueueableSmsSenderInterface)
        {
            $this->mailer->sendAllFromQueue();
        }
    }

}
