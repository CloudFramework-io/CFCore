<?php

use CloudFramework\Core\CloudFrameworkApp;

class CloudFrameworkTest extends PHPUnit_Framework_TestCase
{
    public function testInstanceCreation()
    {
        $cf = CloudFrameworkApp::create('test-app');

        $this->assertNotNull($cf, 'Create an instance of CloudFrameworkApp');
        $this->assertInstanceOf('\CloudFramework\Patterns\Schemas\SingletonInterface', $cf, 'CloudFrameworkApp have to be SingletonInterface');
        $this->assertInstanceOf('\CloudFramework\Patterns\Singleton', $cf, 'CloudFramework have to extend of Singleton');
        $this->assertInstanceOf('\CloudFramework\Core\CloudFrameworkApp', $cf, 'Created object must be as creation definition class');
    }
}