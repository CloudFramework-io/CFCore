<?php
namespace CloudFramework\Patterns\Schemas;

interface AnnotationInterface extends SingletonInterface {
    /**
     * Parse properties annotations and extract classes referencies for this
     * @param string $propertyName
     * @param string $docComments
     * @param array $properties
     * @return array
     */
    public function parse($propertyName, $docComments = '', &$properties = array());
}
