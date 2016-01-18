<?php

require_once 'autoload.php';

$app = \CloudFramework\CloudFrameworkApp::getInstance('cloud-framework', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app.yaml');
$app->run();
