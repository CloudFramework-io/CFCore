<?php
namespace CloudFramework\Patterns;
use CloudFramework\Helpers\SingletonTrait;
use CloudFramework\Patterns\Schemas\AnnotationInterface;

/**
 * Class Annotations
 * @package CloudFramework\Patterns
 */
abstract class Annotation implements AnnotationInterface
{
    use SingletonTrait;


    /**
     * Extract class namespace in doc comments of class properties
     * @param string $doc
     * @return null|string
     */
    protected static function extractVarType($doc)
    {
        $type = null;
        if (false !== preg_match('/@var\s+([^\s]+)/', $doc, $matches)) {
            list(, $type) = $matches;
        }
        return $type;
    }

    public function init()
    {

    }

}
