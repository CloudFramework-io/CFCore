<?php
namespace CloudFramework\Core;
use CloudFramework\Core\Tool\RequestParser;
use CloudFramework\Helpers\Response;
use CloudFramework\Patterns\Singleton;

/**
 * Class CloudFramework
 * @package CloudFramework\Core
 */
class CloudFrameworkApp extends Singleton
{
    use Response;

    /**
     * @var string
     */
    private $app_name;

    /**
     * @var \CloudFramework\Core\Tool\ConfigLoader $config
     */
    protected $config;

    /**
     * @Autowired
     * @var \CloudFramework\Core\Tool\RequestParser $request
     */
    protected $request;

    public function __construct($name = 'CloudFramework', $configFile = '')
    {
        $this->app_name = $name;
    }

    public function run()
    {
        echo "Hello " . RequestParser::getQueryParam('name');
    }
}
