<?php
namespace CloudFramework\Patterns\Schemas;

interface SingletonInterface
{
    public function init();
    public static function getInstance();
    public static function create();
}
