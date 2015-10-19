<?php
namespace CloudFramework\Helpers;
use CloudFramework\Patterns\Schemas\SingletonInterface;

/**
 * Class SingletonTrait
 * @package CloudFramework\Helpers
 */
Trait SingletonTrait {

    private static $instance = array();
    /**
     * @var float $loadTs
     */
    private $loadTs = 0;
    /**
     * @var float $loadMem
     */
    private $loadMem = 0;

    /**
     * Singleton instance generator
     * @return $this
     */
    public static function getInstance()
    {
        $ts = microtime(true);
        $class = get_called_class();
        if (!array_key_exists($class, self::$instance) || null === self::$instance[$class]) {
            self::$instance[$class] = self::instanceClass($class, $ts, func_get_args());
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
     * Generic constructor for all Singleton classes
     * @param string $class
     * @param float $ts
     * @param array $args
     * @return \CloudFramework\Patterns\Schemas\SingletonInterface
     */
    private static function instanceClass($class, $ts, array $args = array())
    {
        $reflectionClass = new \ReflectionClass($class);
        /** @var \CloudFramework\Patterns\Schemas\SingletonInterface $instanceClass */
        if (null !== $reflectionClass->getConstructor() && $reflectionClass->getConstructor()->getNumberOfParameters() > 0) {
            $instanceClass = $reflectionClass->newInstanceArgs($args);
        } else {
            $instanceClass = $reflectionClass->newInstance();
        }
        self::initializeInstance($ts, $reflectionClass, $instanceClass);
        unset($reflectionClass);
        return $instanceClass;
    }

    /**
     * Initialize instance with pre-conditions and post-conditions
     * @param float $ts
     * @param \ReflectionClass $reflectionClass
     * @param \CloudFramework\Patterns\Schemas\SingletonInterface $instanceClass
     */
    private static function initializeInstance($ts, \ReflectionClass $reflectionClass, SingletonInterface $instanceClass)
    {
        try {
            $reflectionClass->getMethod('preInit')->invoke($instanceClass);
        } catch (\Exception $e) {
            //Do nothing
        }
        $instanceClass->init($ts);
        try {
            $reflectionClass->getMethod('postInit')->invoke($instanceClass);
        } catch (\Exception $e) {
            //Do nothing
        }
    }

    /**
     * Calculate timestamp and memory usage for loading class instance
     * @param float $ts
     * @param float $mem
     * @return $this
     */
    public function computePerformance($ts, $mem)
    {
        $this->loadMem = round((memory_get_usage() - $mem) / (1024 * 1024), 4);
        $this->loadTs = round(microtime(true) - $ts, 5);
        return $this;
    }

    /**
     * Inizialization method
     */
    public function init() {}
}
