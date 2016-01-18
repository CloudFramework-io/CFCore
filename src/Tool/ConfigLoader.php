<?php
namespace CloudFramework\Tool;

use CloudFramework\Exceptions\LoaderException;
use CloudFramework\Patterns\Singleton;

/**
 * Class ConfigLoader
 * @package CloudFramework\Core
 */
class ConfigLoader extends Singleton
{
    private $config = array();

    public function __construct($configFilename = '')
    {
        parent::__construct();
        $this->loadConfigFile($configFilename);
    }

    /**
     * Create directory
     * @param string $directory
     * @return bool
     */
    public static function createDir($directory)
    {
        return (false !== @mkdir($directory));
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
        if (count($config) > 0) {
            $configKey = explode(".", trim($key));
            $parentKey = reset($configKey);
            $existsKeyInConfig = array_key_exists($parentKey, $config);
            if (count($configKey) > 1 && $existsKeyInConfig) {
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
        if (false !== $dotPosition) {
            $childKey = substr($key, $dotPosition + 1, strlen($key) - $dotPosition);
        }
        return $childKey;
    }

    /**
     * Set a config parameter
     * @param string $key
     * @param mixed $value
     * @return \CloudFramework\ConfigLoader
     */
    public function setConfigParam($key, $value = null)
    {
        $this->config = $this->setConfigValue($key, $value, $this->config);
        return $this;
    }

    /**
     * Recursive process that set a config value
     * @param string $key
     * @param mixed $value
     * @param mixed $config
     * @return array
     */
    private function setConfigValue($key, $value = null, $config = null)
    {
        $keys = explode('.', $key);
        if (count($keys) === 0) {
            $keys = array($key);
        }
        $keyCount = count($keys);
        $aux = $config;
        foreach ($keys as $_key) {
            $keyCount--;
            if (!array_key_exists($_key, $aux)) {
                $aux[$_key] = array();
            }
            if ($keyCount > 0) {
                $aux[$_key]  = $this->setConfigValue($this->getChildConfigKey($key), $value, $aux[$_key]);
            } else {
                $aux[$_key] = $value;
            }
            break;
        }
        return $aux;
    }

    /**
     * Reload config file
     * @param $configFilename
     * @throws \Exception
     */
    public function loadConfigFile($configFilename = '')
    {
        if (strlen($configFilename) > 0 && file_exists($configFilename)) {
            $this->config = array();
        }
    }
}
