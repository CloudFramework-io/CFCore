<?php
namespace CloudFramework\Patterns;

/**
 * Class CFClass
 * @package CloudFramework\Patterns
 */
abstract class CFClass extends Singleton
{

    public function dumpClassFile()
    {
        $reflection = new \ReflectionClass($this);
        return htmlspecialchars(file_get_contents($reflection->getFileName()));

    }

}
