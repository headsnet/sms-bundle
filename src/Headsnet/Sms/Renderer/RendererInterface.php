<?php
declare(strict_types=1);

namespace Headsnet\Sms\Renderer;

use Headsnet\Sms\Exception\SmsException;
use Headsnet\Sms\Mapping\TemplateMappingInterface;
use Headsnet\Sms\Model\Interfaces\SmsMessageInterface;
use Headsnet\Sms\Model\Interfaces\TransformedSmsMessageInterface;

/**
 * Interface RendererInterface
 */
interface RendererInterface
{

    /**
     * @param TemplateMappingInterface $mapping
     * @return RendererInterface
     */
    public function addMapping(TemplateMappingInterface $mapping);

    /**
     * Transforms SwiftTransformationInterface to \Swift_Message using EngineInterface
     * In case of any errors an instance of MailingException is thrown
     * 
     * Also applies the filters.
     * 
     * @param SmsMessageInterface $smsMessage
     *
     * @return TransformedSmsMessageInterface
     * @throws SmsException
     */
    public function render(SmsMessageInterface $smsMessage);

}
