<?php
    namespace CloudFrameworkTest\Patterns;
    require_once __DIR__ . '/../../src/autoload.php';

    class SingletonTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * Test creation of instance
         *
         * @param string $instanceClass
         *
         * @return \CloudFramework\Patterns\Singleton
         */
        public function testInstanceCreation($instanceClass = '\CloudFramework\CloudFrameworkApp')
        {
            /** @var \CloudFramework\Patterns\Singleton $instanceClass */
            /** @var \CloudFramework\Patterns\Singleton $instance */
            $instance = NULL;
            try {
                $instance = $instanceClass::getInstance();
                $this->assertNotNull($instance, 'Create an instance of ' . $instanceClass);
                $this->assertInstanceOf('\CloudFramework\Patterns\Singleton', $instance, 'CloudFramework have to extend of Singleton');
                $this->assertInstanceOf($instanceClass, $instance, 'Created object must be as creation definition class');
            } catch (\Exception $e) {
                $this->fail('Can not create ' . $instanceClass . ' instance: ' . $e->getMessage());
            }

            return $instance;
        }

        /**
         * Test singleton instance
         *
         * @param string $instanceClass
         *
         * @return boolean
         */
        public function checkSingletonInstance($instanceClass = '\CloudFramework\CloudFrameworkApp')
        {
            $instance1 = $this->testInstanceCreation($instanceClass);
            $instance2 = $this->testInstanceCreation($instanceClass);
            $this->assertNotNull($instance1);
            $instance1->app_name = 'myName';
            $this->assertNotNull($instance2);
            $this->assertEquals($instance1, $instance2);
        }

    }
