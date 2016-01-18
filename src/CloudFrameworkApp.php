<?php
namespace CloudFramework;
use CloudFramework\Tool\ConfigLoader;
use CloudFramework\Tool\RequestParser;
use CloudFramework\Patterns\Singleton;

/**
 * Class CloudFramework
 * @package CloudFramework\Core
 */
class CloudFrameworkApp extends Singleton
{

    /**
     * @var string
     */
    private $app_name;

    /**
     * @var \CloudFramework\Tool\ConfigLoader $config
     */
    protected $config;


    public function __construct($name = 'CloudFramework', $configFile = '')
    {
        $this->app_name = $name;
        $this->config = ConfigLoader::getInstance($configFile);
    }

    public function run()
    {
        echo "Hello " . RequestParser::getQueryParam('name') . '<br>' . $this . "<pre>";
    }
}
