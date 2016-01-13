<?php
namespace CloudFramework\Core;

use CloudFramework\Helpers\MagicClass;
use CloudFramework\Patterns\Singleton;

class RequestParser extends Singleton
{
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
     * Request headers
     * @var array $headers
     */
    private $headers = array();

    public function postInit()
    {
        $this->catchRequestHeaders()
            ->catchQueryString()
            ->catchRawData();
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
        if(function_exists("getallheaders")) {
            foreach (getallheaders() as $key => $value) {
                $this->headers[strtolower($key)] = $value;
            }
        }
        return $this;
    }

    /**
     * Catch all post data
     * @return RequestParser
     */
    private function catchRawData()
    {
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, JSON_UNESCAPED_UNICODE);
        if (null === $data) {
            parse_str($rawData, $data);
        }
        $this->data = $data;
        return $this;
    }

    /**
     * Catch query string data
     * @return RequestParser
     */
    private function catchQueryString()
    {
        parse_str($_SERVER['QUERY_STRING'], $this->query);
        return $this;
    }

    /**
     * Get $_SERVER value
     * @param string $key
     * @return null|mixed
     */
    public function getServerKey($key)
    {
        $value = null;
        if (array_key_exists($key, $_SERVER)) {
            $value = $_SERVER[$key];
        }
        return $value;
    }

    /**
     * Get $_FILES value
     * @param string $key
     * @return array
     */
    public function getUploadedFile($key)
    {
        $file = array();
        if (array_key_exists($key, $_FILES)) {
            $file = $_FILES[$key];
        }
        return $file;
    }
}