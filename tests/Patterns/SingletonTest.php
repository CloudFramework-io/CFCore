<?php
namespace CloudFrameworkTest\Patterns;
require_once __DIR__ . '/../../src/autoload.php';


use CloudFramework\Helpers\SingletonTrait;
use CloudFramework\Patterns\Schemas\SingletonInterface;
use CloudFrameworkTest\Examples\SimpleClass;

class SingletonTest extends \PHPUnit_Framework_TestCase implements SingletonInterface
{
    use SingletonTrait;
    /**
     * Test creation of instance
     * @param string $instanceClass
     * @return \CloudFramework\Patterns\Schemas\SingletonInterface
     */
    public function testInstanceCreation($instanceClass = '\CloudFramework\Core\CloudFrameworkApp')
    {
        /** @var \CloudFramework\Patterns\Schemas\SingletonInterface $instanceClass */
        /** @var \CloudFramework\Patterns\Schemas\SingletonInterface $instance */
        $instance = null;
        try {
            $instance = $instanceClass::getInstance();
            $this->assertNotNull($instance, 'Create an instance of ' . $instanceClass);
            $this->assertInstanceOf('\CloudFramework\Patterns\Schemas\SingletonInterface', $instance, 'CloudFrameworkApp have to be SingletonInterface');
            $this->assertInstanceOf('\CloudFramework\Patterns\Singleton', $instance, 'CloudFramework have to extend of Singleton');
            $this->assertInstanceOf($instanceClass, $instance, 'Created object must be as creation definition class');
        } catch (\Exception $e) {
            $this->fail('Can not create ' . $instanceClass . ' instance: ' . $e->getMessage());
        }
        return $instance;
    }

    /**
     * Test singleton instance
     * @param string $instanceClass
     * @return boolean
     */
    public function checkSingletonInstance($instanceClass = '\CloudFramework\Core\CloudFrameworkApp')
    {
        $instance1 = $this->testInstanceCreation($instanceClass);
        $instance2 = $this->testInstanceCreation($instanceClass);
        $this->assertNotNull($instance1);
        $this->assertNotNull($instance2);
        $this->assertEquals($instance1, $instance2);
    }

    public function testAutowireInyection()
    {
        /** @var \CloudFrameworkTest\Examples\InyectTest $testClass */
        $testClass = $this->testInstanceCreation('\CloudFrameworkTest\Examples\InyectTest');

        $this->assertNotNull($testClass->config);
        $this->assertInstanceOf('\CloudFramework\Core\Tool\ConfigLoader', $testClass->config);

        $this->assertNotNull($testClass->testClass);
        $this->assertInstanceOf('\CloudFrameworkTest\Examples\SimpleClass', $testClass->testClass);

        $test = new SimpleClass();
    }
}
