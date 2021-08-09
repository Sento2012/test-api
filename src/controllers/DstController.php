<?php

namespace Api\Controllers;

use Api\Components\DstManager;

class DstController extends BaseController
{
    public function getLocalTime(string $id): array
    {
        $localTime = $this->di->get(DstManager::class)->getLocalTime($id);

        if ($localTime) {
            return [
                'status' => BaseController::STATUS_OK,
                'time' => $localTime,
            ];
        }

        return ['status' => BaseController::STATUS_FAIL];
    }

    public function getUtcTime(string $id, string $localTime): array
    {
        $localTime = $this->di->get(DstManager::class)->getUtcTime($id, $localTime);

        if ($localTime) {
            return [
                'status' => BaseController::STATUS_OK,
                'time' => $localTime,
            ];
        }

        return ['status' => BaseController::STATUS_FAIL];
    }
}