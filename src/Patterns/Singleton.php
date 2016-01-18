<?php
namespace CloudFramework\Patterns;


/**
 * Class Singleton
 * @package CloudFramework\Patterns
 */
class Singleton
{

    private static $instance = array();
    /**
     * @var float $loadTs
     */
    protected $loadTs = 0;
    /**
     * @var float $loadMem
     */
    protected $loadMem = 0;

    /**
     * @var bool Flag thath indicates that actual class is already loaded
     */
    protected $loaded = false;

    public function __construct()
    {
    }

    /**
     * Singleton instance generator
     * @return $this
     */
    public static function getInstance()
    {
        $ts = microtime(true);
        $class = get_called_class();
        if (!array_key_exists($class, self::$instance) || null === self::$instance[$class]) {
            self::$instance[$class] = new $class(func_get_args());
        }
        return self::$instance[$class];
    }

    /**
     * Instance generator alias
     * @return $this
     */
    public static function create()
    {
        return self::getInstance(func_get_args());
    }

    /**
     * Magic setter
     * @param string $variable
     * @param mixed $value
     */
    public function __set($variable, $value)
    {
        $this->$variable = $value;
    }

    /**
     * Magic getter
     * @param string $variable
     * @return mixed
     */
    public function __get($variable)
    {
        return $this->$variable;
    }

    /**
     * Prevent the instance from being cloned
     * @return void
     */
    private function __clone() {}

    public function __toString()
    {
        $size = round(strlen(print_r($this, true)) / 1024, 4);
        return get_class($this) . " " . $size . " Kbytes";
    }
}
