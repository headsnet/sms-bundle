<?php
declare(strict_types=1);

namespace Headsnet\Sms;

use Headsnet\Sms\Factory\SmsFactory;

/**
 * Interface SmsSendingInterface
 */
interface SmsSendingInterface
{

    /**
     * Get mailer
     * @return SmsSenderInterface|QueueableSmsSenderInterface
     */
    public function getSmsSender();

    /**
     * Get mail factory
     * @return SmsFactory
     */
    public function getFactory();

}
