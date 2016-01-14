<?php
namespace CloudFrameworkTest\Examples;

use CloudFramework\Patterns\Singleton;

/**
 * Class InyectTest
 * @package CloudFrameworkTest\Examples
 */
class InyectTest extends Singleton
{
    /**
     * @Autowired
     * @var \CloudFramework\Core\Tool\ConfigLoader $config
     */
    protected $config;

    /**
     * @Autowired
     * @var \CloudFrameworkTest\Examples\SimpleClass $testClass
     */
    protected $testClass;

    /**
     * Setter test for TestClass
     * @param SimpleClass $simpleClass
     */
    public function setTestClass(SimpleClass $simpleClass)
    {
        $this->testClass = $simpleClass;
    }
}