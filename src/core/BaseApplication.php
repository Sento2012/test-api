<?php

namespace Api\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

abstract class BaseApplication
{
    public function __construct(array $config)
    {
        $this->loadClasses();
        \ConfigManager::load($config);
        $this->loadDatabase();
    }

    private function loadDatabase(): void
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => \ConfigManager::getDatabase(Enum::DATABASE_CONFIG_DRIVER),
            'host' => \ConfigManager::getDatabase(Enum::DATABASE_CONFIG_HOST),
            'database' => \ConfigManager::getDatabase(Enum::DATABASE_CONFIG_DATABASE),
            'username' => \ConfigManager::getDatabase(Enum::DATABASE_CONFIG_USER),
            'password' => \ConfigManager::getDatabase(Enum::DATABASE_CONFIG_PASSWORD),
            'charset' => \ConfigManager::getDatabase(Enum::DATABASE_CONFIG_CHARSET),
            'collation' => \ConfigManager::getDatabase(Enum::DATABASE_CONFIG_COLLATION),
            'port' => \ConfigManager::getDatabase(Enum::DATABASE_CONFIG_PORT),
            'prefix' => \ConfigManager::getDatabase(Enum::DATABASE_CONFIG_PREFIX),
        ]);
        $capsule->setAsGlobal();
    }

    private function loadClasses(string $directory = '.'): void
    {
        if (preg_match('/(vendor|tests)/', $directory)) {
            return;
        }
        if (is_dir($directory)) {
            $scan = scandir($directory);
            unset($scan[0], $scan[1]);
            foreach ($scan as $file) {
                if (is_dir($directory . '/' . $file)) {
                    $this->loadClasses($directory . '/' . $file);
                } else {
                    if (preg_match('/\.php$/isu', $file)) {
                        require_once $directory . "/" . $file;
                    }
                }
            }
        }
    }

    abstract public function run(): void;
}