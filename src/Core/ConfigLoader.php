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

    public function __construct($configFilename = '')
    {
        parent::__construct();
        if(strlen($configFilename) > 0 && file_exists($configFilename)) {
            $this->config = ConfigLoader::parseYamlConfigFile($configFilename);
        }
    }

    /**
     * Parser YAML configuration file
     * @param string $filename
     * @return array
     * @throws \Symfony\Component\Yaml\Exception\ParseException If the YAML is not valid
     */
    public static function parseYamlConfigFile($filename = null)
    {
        return Yaml::parse(file_get_contents($filename));
    }

    /**
     * Search config key and returns this value
     * @param string $key
     * @param array $config
     * @return mixed
     */
    public function getConfigParam($key, $config = array())
    {
        $config = (count($config) == 0) ? $this->config : $config;
        $value = null;
        if(count($config) > 0) {
            $configKey = explode(".", trim($key));
            $parentKey = reset($configKey);
            $existsKeyInConfig = array_key_exists($parentKey, $config);
            if(count($configKey) > 1 && $existsKeyInConfig) {
                $value = $this->getConfigParam($this->getChildConfigKey($key), $config[$parentKey]);
            } elseif ($existsKeyInConfig) {
                $value = $config[$parentKey];
            }
        }
        return $value;
    }

    /**
     * Extract child keys from parent config key
     * @param string $key
     * @return string
     */
    private function getChildConfigKey($key)
    {
        $childKey = '';
        $dotPosition = strpos($key, '.');
        if(false !== $dotPosition) {
            $childKey = substr($key, $dotPosition + 1, strlen($key) - $dotPosition);
        }
        return $childKey;
    }
}
