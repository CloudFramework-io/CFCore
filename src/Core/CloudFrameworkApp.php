<?php
namespace CloudFramework\Core;

use CloudFramework\Helpers\Response;
use CloudFramework\Patterns\CFClass;

/**
 * Class CloudFramework
 * @package CloudFramework\Core
 */
class CloudFrameworkApp extends CFClass
{
    use Response;
    private $app_name;

    /**
     * @var \CloudFramework\Core\ConfigLoader $config
     */
    protected $config;

    /**
     * @Autowired
     * @var \CloudFramework\Core\RequestParser $request
     */
    protected $request;

    public function __construct($name = 'CloudFramework', $configFile = '')
    {
        $this->app_name = $name;
        $this->config = ConfigLoader::getInstance($configFile);
    }

    public function run()
    {
        $this->debugText(print_r($this, true));
    }
}
