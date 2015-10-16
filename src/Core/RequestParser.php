<?php
namespace CloudFramework\Core;

use CloudFramework\Helpers\MagicClass;
use CloudFramework\Patterns\Singleton;

class RequestParser extends Singleton
{
    use MagicClass;
    /**
     * Query string params
     * @var array $query
     */
    private $query = array();
    /**
     * Raw Data params
     * @var array $data
     */
    private $data = array();
    /**
     * Upload files
     * @var array $files
     */
    private $uploads = array();
    /**
     * Request headers
     * @var array $headers
     */
    private $headers = array();

    public function init()
    {
        parent::init();
        $this->catchRequestHeaders();
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function getHeader($key)
    {
        $key = strtolower(trim($key));
        return (array_key_exists($key, $this->headers)) ? $this->headers[$key] : null;
    }

    /**
     * Catch all request headers
     * @return RequestParser
     */
    private function catchRequestHeaders()
    {
        foreach(getallheaders() as $key => $value) {
            $this->headers[strtolower($key)] = $value;
        }
        return $this;
    }

    /**
     * Catch all post data
     * @return RequestParser
     */
    private function catchRawData()
    {
        $rawData = json_file_get_contents('php://input');
        $data = json_decode($rawData, JSON_UNESCAPED_UNICODE);
        if(null === $data) {
            $data = parse_str($rawData);
        }
        $this->data = $data;
        return $this;
    }
}