<?php

use Api\Controllers\DstController;
use Api\Core\Enum;

return [
    Enum::CONFIG_ROUTES => [
        [
            Enum::CONFIG_ROUTES_NAME => 'get-local-time',
            Enum::CONFIG_ROUTES_ROUTE => '/dst/get-local-time/{id}',
            Enum::CONFIG_ROUTES_ACTION => ['_controller' => DstController::class . '::getLocalTime'],
            Enum::CONFIG_ROUTES_METHODS => ['GET'],
            Enum::CONFIG_ROUTES_PARAMS => ['id' => '[\w\-]+'],
        ],
        [
            Enum::CONFIG_ROUTES_NAME => 'get-utc-time',
            Enum::CONFIG_ROUTES_ROUTE => '/dst/get-utc-time/{id}/{localTime}',
            Enum::CONFIG_ROUTES_ACTION => ['_controller' => DstController::class . '::getUtcTime'],
            Enum::CONFIG_ROUTES_METHODS => ['GET'],
            Enum::CONFIG_ROUTES_PARAMS => ['id' => '[\w\-]+'],
        ],
    ],
    Enum::DATABASE_CONFIG => [
        Enum::DATABASE_CONFIG_DRIVER => 'mysql',
        Enum::DATABASE_CONFIG_HOST => 'db-test-api',
        Enum::DATABASE_CONFIG_DATABASE => 'root',
        Enum::DATABASE_CONFIG_USER => 'root',
        Enum::DATABASE_CONFIG_PASSWORD => 'root',
        Enum::DATABASE_CONFIG_CHARSET => 'utf8',
        Enum::DATABASE_CONFIG_COLLATION => 'utf8_unicode_ci',
        Enum::DATABASE_CONFIG_PORT => 3306,
        Enum::DATABASE_CONFIG_PREFIX => '',
    ],
    Enum::TIMEZONE_API_KEY => 'FTP62P35AHF5',
];
