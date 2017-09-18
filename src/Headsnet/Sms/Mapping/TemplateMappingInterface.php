<?php
declare(strict_types=1);

namespace Headsnet\Sms\Mapping;

/**
 * Classes implementing this interface are used to define which templates are available
 */
interface TemplateMappingInterface
{

    /**
     * Get mappings
     *
     * @return array
     *
     * Example:
     *   ['default' => ['MyBundle:Sms:welcome.text.twig']
     */
    public function getMappings();

}
