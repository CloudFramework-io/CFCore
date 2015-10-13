<?php
namespace CloudFramework\Annotations;
use CloudFramework\Patterns\Annotation;

/**
 * Annotations Autowired to inject class reference on instances creation
 * @package CloudFramework\Annotations
 */
class Autowired extends Annotation
{
    /**
     * Flag for generate a new instance or Singleton instance of class inyected
     * @var bool $singleton
     */
    public $singleton = true;

    /**
     * Array of parameters for instance construction
     * @var array $params
     */
    public $params = [];

    /**
     * Parse properties annotations and extract classes referencies for this
     * @param string $propertyName
     * @param string $docComments
     * @param array $properties
     * @return array
     */
    public function parse($propertyName, $docComments = '', &$properties = array()) {
        if (preg_match('/@Autowired/im', $docComments)) {
            $instanceType = self::extractVarType($docComments);
            if (null !== $instanceType) {
                $properties[$propertyName] = $instanceType;
            }
        }
        return $properties;
    }
}
