<?php
namespace CloudFramework\Patterns;

use CloudFramework\Annotations\Autowired;
use CloudFramework\Helpers\MagicClass;
use CloudFramework\Helpers\SingletonTrait;
use CloudFramework\Patterns\Schemas\SingletonInterface;

/**
 * Class Singleton
 * @package CloudFramework\Patterns
 */
class Singleton implements SingletonInterface
{
    use SingletonTrait;
    use MagicClass;
    /**
     * @var bool Flag thath indicates that actual class is already loaded
     */
    protected $loaded = false;

    public function __construct()
    {
    }

    /**
     * Execution of pre conditions before initialization of class
     */
    public function preInit()
    {
    }

    /**
     * Execution of post conditions after initialization of class
     */
    public function postInit()
    {
    }

    /**
     * Returns if class is already loaded
     * @return bool
     */
    public function isLoaded()
    {
        return $this->loaded;
    }

    /**
     * Set class is loaded or not
     * @param bool $loaded
     */
    public function setLoaded($loaded = true)
    {
        $this->loaded = $loaded;
    }

    /**
     * HELPERS
     */

    /**
     * Depedency injection service
     * @param string $variable
     * @param bool $singleton
     * @param string $classNameSpace
     * @return $this
     */
    public function load($variable, $singleton = true, $classNameSpace = null)
    {
        $calledClass = get_called_class();
        try {
            $instance = $this->constructInyectableInstance($variable, $singleton, $classNameSpace, $calledClass);
            $setter = "set" . ucfirst($variable);
            if (method_exists($calledClass, $setter)) {
                $this->$setter($instance);
            } else {
                $this->$variable = $instance;
            }
        } catch (\Exception $e) {
            //TODO implements logger interface
        }
        return $this;
    }

    /**
     * Creation method that inject dependencies classes into instance class
     * @param float $ts
     * @return $this
     */
    public function init($ts = null)
    {
        $mem = memory_get_usage();
        $ts = (null !== $ts) ? $ts : microtime(true);
        if (!$this->isLoaded()) {
            $properties = $this->getClassProperties();
            /** @var \ReflectionProperty $property */
            if (!empty($properties) && is_array($properties)) {
                foreach ($properties as $property => $class) {
                    $this->load($property, true, $class);
                }
            }
            $this->setLoaded();
        }
        return $this->computePerformance($ts, $mem);
    }

    /**
     * Extract the class inyectables properties
     * @param string $class
     * @return array
     */
    private function getClassProperties($class = null)
    {
        $properties = array();
        if (null === $class) {
            $class = get_class($this);
        }
        $selfReflector = new \ReflectionClass($class);
        if (false !== $selfReflector->getParentClass()) {
            $properties = $this->getClassProperties($selfReflector->getParentClass()->getName());
        }
        foreach ($selfReflector->getProperties(\ReflectionProperty::IS_PROTECTED) as $property) {
            $doc = $property->getDocComment();
            $propertyName = $property->getName();
            $properties = Autowired::create()->parse($propertyName, $doc, $properties);
        }
        return $properties;
    }

    /**
     * Create instance of class properties
     * @param string $variable
     * @param bool $singleton
     * @param string $classNameSpace
     * @param string $calledClass
     * @return mixed
     * @throws \Exception
     */
    private function constructInyectableInstance($variable, $singleton, $classNameSpace, $calledClass)
    {
        $reflector = new \ReflectionClass($calledClass);
        $property = $reflector->getProperty($variable);
        $varInstanceType = (null === $classNameSpace) ? Annotation::extractVarType($property->getDocComment()) : $classNameSpace;
        return $this->injectInstance($singleton, $varInstanceType);
    }

    /**
     * Create an object instance
     * @param bool $singleton
     * @param string $instanceType
     * @return null|Object
     */
    private function injectInstance($singleton, $instanceType)
    {
        $instance = null;
        try {
            $instanceReflector = new \ReflectionClass($instanceType);
            try {
                if ($singleton) {
                    $instance = $instanceReflector->getMethod("getInstance")->invoke(null);
                }
            } catch(\Exception $e) {
                $singleton = false;
            }
            if (!$singleton) {
                $instance = $instanceReflector->newInstance();
            }
        } catch (\Exception $e) {
            //TODO implements logger interface
        }
        return $instance;
    }
}
