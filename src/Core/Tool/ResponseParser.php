<?php
    namespace CloudFramework\Core\Tool;

    use CloudFramework\Helpers\Response;
    use CloudFramework\Patterns\Singleton;

    /**
     * Class ResponseParser
     * @package CloudFramework\Core\Tool
     */
    class ResponseParser extends Singleton{
        use Response;
    }