<?php
namespace CloudFramework\Patterns\Schemas;

interface SingletonInterface
{
    public function init();
    public function getInstance();
    public function create();
}
