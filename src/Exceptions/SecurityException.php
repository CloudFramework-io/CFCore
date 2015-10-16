<?php
namespace CloudFramework\Exceptions;

class SecurityException extends \Exception
{
    public function __construct()
    {
        list($message, $code, $previus) = func_get_args();
        parent::__construct($message, $code, $previus);
    }
}