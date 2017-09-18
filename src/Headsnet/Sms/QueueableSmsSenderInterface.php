<?php
declare(strict_types=1);

namespace Headsnet\Sms;

use Headsnet\Sms\Exception\SmsException;
use Headsnet\Sms\Model\SmsMessage;

/**
 * Interface QueueableSmsSenderInterface
 */
interface QueueableSmsSenderInterface extends SmsSenderInterface
{

    /**
     * Add mail to queue
     *
     * @param SmsMessage $smsMessage
     *
     * @return QueueableSmsSenderInterface
     */
    public function enqueue(SmsMessage $smsMessage);

    /**
     * Send first message from the queue
     *
     * @return QueueableSmsSenderInterface
     * @throws SmsException
     */
    public function sendFirstFromQueue();

    /**
     * Send all mails from the queue
     *
     * @return QueueableSmsSenderInterface
     */
    public function sendAllFromQueue();

}
