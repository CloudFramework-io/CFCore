<?php

require_once 'autoload.php';

$app = \CloudFramework\Core\CloudFrameworkApp::getInstance('cloud-framework', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app.yaml');
$app->run();
