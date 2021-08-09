<?php

namespace Api\Core;

class Response
{
    private array $controller;
    private array $arguments;

    public function __construct(
        array $controller,
        array $arguments
    ) {
        $this->controller = $controller;
        $this->arguments = $arguments;
    }

    public function process(): array
    {
        return call_user_func_array($this->controller, $this->arguments);
    }
}