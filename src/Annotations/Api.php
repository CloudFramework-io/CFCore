<?php
namespace CloudFramework\Annotations;

use CloudFramework\Patterns\Annotation;

/**
 * Class Api
 * @package CloudFramework\Annotations
 */
class Api extends Annotation
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