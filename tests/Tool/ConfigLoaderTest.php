<?php
    namespace CloudFrameworkTest\Tool;
    use CloudFramework\Tool\ConfigLoader;

    /**
     * Class ConfigLoaderTest
     * @package CloudFrameworkTest\Tool
     */
    class ConfigLoaderTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * Test ConfigLoader basic functions
         */
        public function testConfigBasic()
        {
            $config = ConfigLoader::getInstance();
            //Try physical structure of the class
            try {
                $this->assertNotNull($config, 'ConfigLoader is null');
                $this->assertInstanceOf('\CloudFramework\Patterns\Singleton', $config, 'ConfigLoader isn\'t an instance of Singleton');
                $this->assertInstanceOf('\CloudFramework\Tool\ConfigLoader', $config, 'ConfigLoader must be an instante of ConfigLoader');
            } catch (\Exception $e) {
                $this->fail('ConfigLoader instatiator fails because: ' . $e->getMessage());
            }
            //Try to set a config var
            $testVar1 = time();
            $config->setConf('test', $testVar1);
            $this->assertNotNull($config->getConf('test'), 'Variable \'test\' is null');
            $this->assertEquals($testVar1, $config->getConf('test'), 'Test variable into ConfigLoader isn\'t the same as initial Test variable');

            //Try to set the same variable with different values
            $testVar2 = 'newValue';
            $config->setConf('test', $testVar2);
            $this->assertNotNull($config->getConf('test'), 'Variable \'test\' is null');
            $this->assertNotEquals($testVar1, $config->getConf('test'), 'Test variable didn\'t change from initial test value');
            $this->assertEquals($testVar2, $config->getConf('test'), 'Test variable is different than expected');
        }
    }