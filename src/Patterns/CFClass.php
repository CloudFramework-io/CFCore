<?php
namespace CloudFramework\Patterns;

use CloudFramework\Core\CloudFrameworkApp;
/**
 * Class CFClass
 * @package CloudFramework\Patterns
 */
abstract class CFClass extends Singleton
{
    private $app;

    public function __construct()
    {
        $this->app = CloudFrameworkApp::getInstance();
    }


}
