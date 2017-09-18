<?php
declare(strict_types=1);

namespace Headsnet\Sms\Renderer;

use Headsnet\Sms\Exception\SmsSenderException;
use Headsnet\Sms\Mapping\TemplateMappingInterface;
use Headsnet\Sms\Model\Interfaces\SmsMessageInterface;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class Renderer renders the SmsMessage and returns a DispatchMessage Instance
 */
class Renderer implements RendererInterface
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var array
     */
    protected $smsParameters;

    /**
     * @var array
     */
    private $mappings = [];

    /**
     * @param EngineInterface $templating
     * @param array           $smsParameters
     */
    public function __construct(EngineInterface $templating, array $smsParameters)
    {
        $this->templating = $templating;
        $this->smsParameters = $smsParameters;
    }

    /**
     * {@inheritdoc}
     */
    public function addMapping(TemplateMappingInterface $mapping)
    {
        $this->mappings = array_merge($this->mappings, $mapping->getMappings());
    }

    /**
     * {@inheritdoc}
     *
     * If no template is found, it falls back to default template
     */
    public function render(SmsMessageInterface $smsMessage)
    {
        $template = $this->getViewData($smsMessage->getTemplate());

        // Adds default email parameters to the view
        foreach($this->smsParameters as $name => $value)
        {
            $smsMessage->addParameter($name, $value);
        }

        return $smsMessage->transform($this->templating, $template);
    }

    /**
     * Get template path
     *
     * @param  string $template
     *
     * @return string
     * @throws SmsSenderException
     */
    private function getViewData($template)
    {
        if (isset($this->mappings[$template]))
        {
            return $this->mappings[$template];
        }

        throw new SmsSenderException(
        	'Specified template "' . $template . '" not found in template map when sending SMS message'
        );
    }

}
