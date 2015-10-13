<?php
namespace CloudFrameworkTest\Core;

use CloudFramework\Core\ConfigLoader;
use CloudFrameworkTest\Patterns\SingletonTest;

class ConfigLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \CloudFrameworkTest\Patterns\SingletonTest $singletonTest
     */
    private $singletonTest;
    protected function setup()
    {
        $this->singletonTest = SingletonTest::create();
    }

    public function testCreateInstance()
    {
        return $this->singletonTest->testInstanceCreation('\CloudFramework\Core\ConfigLoader');
    }

    public function testInstanceCreation()
    {
        $this->singletonTest->checkSingletonInstance('\CloudFramework\Core\ConfigLoader');
    }

    public function testLoadConfig()
    {
        //Parse a file that not exists
        $parsedConfigKO = ConfigLoader::parseYamlConfigFile(uniqid('c') . '.yml');
        $this->assertNull($parsedConfigKO);

        //Parse config file and test if a key exists
        $parsedConfigOK = ConfigLoader::parseYamlConfigFile(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'configtest.yml');
        $this->assertNotNull($parsedConfigOK);
        $this->assertTrue(is_array($parsedConfigOK));
        $this->assertArrayHasKey('ConfigTest', $parsedConfigOK);

        //Create ConfigLoader instance and use this methods
        $config = ConfigLoader::getInstance();
        $config->loadConfigFile(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'configtest.yml');
        $this->assertNotNull($config);
        $this->assertInstanceOf('\CloudFramework\Core\ConfigLoader', $config, '$config isn\'t a ConfigLoader instance');

        //Get a child config value
        $testValue = $config->getConfigParam('ConfigTest.Field2.Timestamp');
        $this->assertNotNull($testValue);
        $this->assertEquals('2015-10-01 00:00:00', $testValue, '$testValue isn\'t equals than expected');

        //Get a config key that not exists
        $nullTestValue = $config->getConfigParam(uniqid('t'));
        $this->assertNull($nullTestValue, '$nullTestValue has a value when expect a null');

        //Set a config params and check the value setted
        $config->setConfigParam("test.test.test", "test");
        $testTimeValue = $config->getConfigParam("test.test.test");
        $this->assertEquals("test", $testTimeValue);

    }

}
