<?php

namespace Api\Core;

use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request as WebRequest;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Request
{
    private RouteCollection $routeCollection;

    public function __construct()
    {
        $this->routeCollection = $this->getRegisterRoutes();
    }

    private function getRegisterRoutes(): RouteCollection
    {
        $routes = new RouteCollection();
        foreach (\ConfigManager::getRoutes() as $routeItem) {
            $route = new Route(
                $routeItem[Enum::CONFIG_ROUTES_ROUTE],
                $routeItem[Enum::CONFIG_ROUTES_ACTION],
                $routeItem[Enum::CONFIG_ROUTES_PARAMS],
                [],
                '',
                [],
                $routeItem[Enum::CONFIG_ROUTES_METHODS],
            );
            $routes->add(
                $routeItem[Enum::CONFIG_ROUTES_NAME],
                $route,
            );
        }

        return $routes;
    }

    public function process(): array
    {
        $request = WebRequest::createFromGlobals();
        $context = new RequestContext();
        $context->fromRequest($request);
        $matcher = new UrlMatcher($this->routeCollection, $context);
        $controllerResolver = new ControllerResolver();
        $argumentResolver = new ArgumentResolver();
        $request->attributes->add($matcher->match($request->getPathInfo()));
        $controller = $controllerResolver->getController($request);
        $arguments = $argumentResolver->getArguments($request, $controller);

        return [$controller, $arguments];
    }
}