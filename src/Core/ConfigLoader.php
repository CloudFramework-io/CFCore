<?php
namespace CloudFramework\Core;

use CloudFramework\Patterns\CFClass;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigLoader
 * @package CloudFramework\Core
 */
class ConfigLoader extends CFClass
{
    private $config = array();

    public function __construct()
    {

    }

    public static function parseConfigFile($filename = null)
    {
        return Yaml::parse(file_get_contents($filename));
    }
}
