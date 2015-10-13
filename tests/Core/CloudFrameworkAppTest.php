<?php
namespace CloudFrameworkTest\Core;

use CloudFrameworkTest\Patterns\SingletonTest;

class CloudFrameworkTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \CloudFrameworkTest\Patterns\SingletonTest $singletonTest
     */
    private $singletonTest;
    protected function setup()
    {
        $this->singletonTest = SingletonTest::create();
    }

    public function testInstanceCreation()
    {
        $this->singletonTest->checkSingletonInstance();
    }
}
