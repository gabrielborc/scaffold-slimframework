<?php

namespace App\Config;

class HandlerError 
{
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function activate() {
        $c = $this->container;

        $c['errorHandler'] = function ($c) {
            return function ($request, $response, $exception) use ($c) {
                return $response->withStatus(500)
                    ->withHeader('Content-Type', 'text/html')
                    ->write('Something went wrong!');
            };
        };
        
        $c['notFoundHandler'] = function ($c) {
            return function ($request, $response) use ($c) {       
                return $response->withStatus(404)
                    ->withHeader('Content-Type', 'text/html')
                    ->write('Page not found');
            };
        };
        
        $c['notAllowedHandler'] = function ($c) {
            return function ($request, $response, $methods) use ($c) {
                return $response->withStatus(405)
                    ->withHeader('Allow', implode(', ', $methods))
                    ->withHeader('Content-type', 'text/html')
                    ->write('Method must be one of: ' . implode(', ', $methods));
            };
        };
        
        $c['phpErrorHandler'] = function ($c) {
            return function ($request, $response, $error) use ($c) {
                return $response->withStatus(500)
                    ->withHeader('Content-Type', 'text/html')
                    ->write('Something went wrong!');
            };
        };
    }

}