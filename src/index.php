<?php

define('__ROOT__', __DIR__);

require_once 'vendor/autoload.php';
require_once 'core/BaseApplication.php';
require_once 'core/ConsoleApplication.php';
require_once 'core/WebApplication.php';
require_once 'core/Enum.php';

use Api\Core\ConsoleApplication;
use Api\Core\WebApplication;

$config = require_once __ROOT__ . '/config.php';
$isCLI = ( php_sapi_name() == 'cli' );
if (!$isCLI) {
    $application = new WebApplication($config);
} else {
    $application = new ConsoleApplication($config);
}
$application->run();
