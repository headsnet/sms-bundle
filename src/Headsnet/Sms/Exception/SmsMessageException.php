<?php
declare(strict_types=1);

namespace Headsnet\Sms\Exception;

/**
 * The purpose of this exception is to be thrown during SMS creation process
 */
class SmsMessageException extends SmsException
{

    /**
     * {@inheritdoc}
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }

}
