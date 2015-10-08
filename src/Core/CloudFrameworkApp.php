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
     * @Autowired(singleton=false)
     * @var \CloudFramework\Core\ConfigLoader $config
     */
    protected $config;
    protected $configSingleton;

    public function __construct($name = 'CloudFramework')
    {
        $this->app_name = $name;
        $this->configSingleton = ConfigLoader::getInstance();
    }

    public function run()
    {
        $this->dumpText("<pre>" . $this->dumpInstance() . "</pre>");
    }
}
