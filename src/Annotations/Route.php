<?php
namespace CloudFramework\Annotations;

use CloudFramework\Patterns\Annotation;

/**
 * Class Route
 * @package CloudFramework\Annotations
 */
class Route extends Annotation
{
    /**
     * Parse properties annotations and extract classes referencies for this
     * @param string $propertyName
     * @param string $docComments
     * @param array $properties
     * @return array
     */
    public function parse($propertyName, $docComments = '', &$properties = array())
    {

    }
}