<?php

namespace Api\Controllers;

use Api\Components\SyncManager;

class CliController extends BaseController
{
    public function sync(): void
    {
        $this->di->get(SyncManager::class)->sync();
    }
}