<?php

namespace Api\Controllers;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

abstract class BaseController
{
    public const STATUS_OK = 'ok';
    public const STATUS_FAIL = 'fail';

    protected ContainerBuilder $di;

    public function __construct()
    {
        $this->di = new ContainerBuilder();
        $loader = new YamlFileLoader($this->di, new FileLocator(__ROOT__));
        $loader->load(__ROOT__ . '/services.yaml');
    }
}
