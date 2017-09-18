<?php
declare(strict_types=1);

namespace Headsnet\Sms\Exception;

/**
 * The purpose of this exception is to be thrown during mail sending process
 */
class SmsSenderException extends SmsException
{

    /**
     * {@inheritdoc}
     */
    public function __construct($message, $code = 500)
    {
        parent::__construct($message, $code);
    }

}
