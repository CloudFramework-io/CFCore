<?php
namespace CloudFramework\Annotations;

use CloudFramework\Patterns\Annotation;

/**
 * Class RequestMethod
 * @package CloudFramework\Annotations
 */
class RequestMethod extends Annotation
{
    /**
     * Parse properties annotations and extract classes references for this
     * @param string $propertyName
     * @param string $docComments
     * @param array $properties
     * @return array
     */
    public function parse($propertyName, $docComments = '', &$properties = array())
    {

    }
}