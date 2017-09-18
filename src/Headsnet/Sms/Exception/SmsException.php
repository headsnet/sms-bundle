<?php
declare(strict_types=1);

namespace Headsnet\Sms\Exception;

use Exception;

/**
 * The purpose of this exception is present a base exception for SMS sending
 */
abstract class SmsException extends Exception
{

    /**
     * {@inheritdoc}
     */
    public function __construct($message, $code = 500, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
