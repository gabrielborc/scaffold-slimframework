<?php

namespace App\Route;

class Route 
{
    private $app;
    private $view;

    public function __construct($app) {
        $this->app = $app;
        $this->view = new \App\View\View();
    }

    public function activate() {
        $app = $this->app;
        $view = $this->view;

        $app->any('/', function ($request, $response, $args) use ($view) {  
            return $response->withBody(
                $view->response('ContactView.html'));
        });
    }

}