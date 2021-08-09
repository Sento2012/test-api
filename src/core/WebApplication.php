<?php

namespace Api\Core;

use Api\Controllers\BaseController;
use Exception;

class WebApplication extends BaseApplication
{
    public function run(): void
    {
        try {
            $request = new Request();
            [$controller, $arguments] = $request->process();
            $response = new Response($controller, $arguments);
            $this->getHeaders();
            echo json_encode($response->process());
        } catch (Exception $e) {
            $this->getHeaders((int) $e->getCode());
            echo json_encode([
                'status' => BaseController::STATUS_FAIL,
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function getHeaders(int $code = 200): void
    {
        if (headers_sent()) {
            return;
        }
        header('HTTP/1.1 ' . (string) $code . ' OK');
        header('Content-type: application/json');
    }
}